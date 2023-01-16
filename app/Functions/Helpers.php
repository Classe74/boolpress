<?php
// App/Functions/Helpers.php
namespace App\Functions;

class Helpers{
    public static function getCsvContents(string $path)
    {
        // Crea un'array vuota
        $data = [];

        // Apri il file stream in lettura
        $file_stream = fopen($path, 'r');

        // Verifica se il file non é stato aperto e mostra errore
        if ($file_stream === false) {
            exit('Cannot open the file '.$path);
        }

        // leggi le singole righe del csv fino alla fine
        // fgetcsv restituisce o l'array o false
        while (($row = fgetcsv($file_stream)) !== false) {
            // salva ciascuna riga come elemento dell'array
            $data[] = $row;
        }

        // chiudi il file
        fclose($file_stream);
        // restituisci i dati
        return $data;
    }
}

