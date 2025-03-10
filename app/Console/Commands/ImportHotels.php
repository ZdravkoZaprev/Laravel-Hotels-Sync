<?php

namespace App\Console\Commands;

use App\Factories\ParserFactory;
use App\Models\City;
use Illuminate\Console\Command;
use App\Models\Hotel;

class ImportHotels extends Command
{
    protected $signature = 'app:import-hotels {fileName} {--delimiter=}';
    protected $description = 'Command for importing Hotels into the database based on the given file';

    protected ParserFactory $parserFactory;

    public function __construct(ParserFactory $parserFactory)
    {
        parent::__construct();
        $this->parserFactory = $parserFactory;
    }

    public function handle()
    {
        $fileName = $this->argument('fileName');
        $delimiter = $this->option('delimiter');

        // Construct the full file path
        $filePath = storage_path('app/import/' . $fileName);

        // Check if the file exists
        if (!file_exists($filePath)) {
            $this->error('File does not exist: ' . $filePath);
            return;
        }

        // Get proper parser based on file extension
        $format = pathinfo($filePath, PATHINFO_EXTENSION);
        $parser = $this->parserFactory->getParser($format);

        if (!$format) {
            $this->error('Unable to detect file format. Supported formats: CSV, JSON');
            return;
        }

        if (!$parser) {
            $this->error("Unsupported format: $format");
            return;
        }

        // Parse the file
        $data = $parser->parse($filePath, $delimiter);
        if (empty($data)) {
            $this->error('No data found in the file.');
            return;
        }

        $success = 0;
        $failed = 0;
        foreach ($data as $hotelData) {
            // Get or create the city
            $city = City::firstOrCreate(['name' => $hotelData['City']]);

            try {
                // Store Hotels into database if they don't exist
                $hotel = Hotel::firstOrCreate(
                    [
                        'name' => $hotelData['Hotel Name'],
                        'city_id' => $city->id,
                    ],
                    [
                        'image' => $hotelData['Image'],
                        'address' => $hotelData['Address'],
                        'description' => $hotelData['Description'],
                        'stars' => $hotelData['Stars'],
                    ]
                );

                $hotel->wasRecentlyCreated ? $success++ : $this->info("Hotel already exists: " . $hotel->name);
            } catch (\Exception $e) {
                $this->error("Failed to save hotel: " . $e->getMessage());
                $failed++;
            }
        }

        $this->info("Successfully imported {$success} hotels. Failed imports: {$failed}.");
        return 0;
    }
}
