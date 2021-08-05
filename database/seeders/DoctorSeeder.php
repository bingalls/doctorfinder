<?php

namespace Database\Seeders;

use DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use Exception;
use Illuminate\Support\Facades\Log;
use JeroenZwart\CsvSeeder\CsvSeeder;
use ZipArchive;

/**
 * @see Flynsarmy\CsvSeeder for possible better time/memory performance?
 * Better yet, use DB native seeder
 */
class DoctorSeeder extends CsvSeeder
{
    // CsvSeeder requires these to be public :(
    // public $chunk = 50;     // Adjusting this default size does not help memory allocation :(
    public $delimiter = ',';
    public $empty = true;   // '' instead of NOT NULL
    public $file;
    public $tablename = 'doctors';

    /**
     * Downloads & extracts Open Payments data.
     * As this can throw an exception, consider moving out of the constructor
     * @throws GuzzleException
     */
    public function __construct()
    {
        //$zipPath = __DIR__ . '/database/';
        $zipPath = './';   // relative to seeders path
        $zipFile = $zipPath . 'docs.zip';
        $this->file = $zipPath . 'doctors.csv';

        // PHP converts CSV into array, forcing it all to be loaded
        // ToDo stream instead, with https://csv.thephpleague.com/9.0/connections/filters/
        // See also Symfony\Component\HttpFoundation\StreamedResponse
        ini_set('memory_limit', '2048m');    // TODO you may need to edit php.ini
        ini_set('set_time_limit', 0);
        if (!ini_get('auto_detect_line_endings')) {
            ini_set('auto_detect_line_endings', '1');
        }

        $client = new Client();
        $resource = Utils::tryFopen($zipFile, 'w');
        try {
            $client->get(
                'https://download.cms.gov/openpayments/PHPRFL_P063021.ZIP',
                ['sink' => $resource]
            );
            $archive = new ZipArchive();
            $archive->open($zipFile);
            $archive->extractTo($zipPath);
            $archive->close();
        } catch (Exception $exception) {
            $this->file = null;
            Log::error(__METHOD__ . var_export($exception, true));
        }
    }

    /**
     * Seeding all doctors takes ~30 minutes!
     *
     * @return void
     */
    public function run(): void
    {
        DB::disableQueryLog();
        DB::table($this->tablename)->truncate();
        parent::run();
    }
}
