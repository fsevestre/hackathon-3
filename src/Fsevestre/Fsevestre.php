<?php

namespace Hackathon3\Fsevestre;

class Fsevestre
{
    /**
     * TODO: Améliorer les performances (-> mémoire utilisée uniquement <-) de cette méthode.
     * TODO: La création d'autres méthodes ou classes est autorisée, tant que les tests passent (sans être modifiés).
     */
    public function getLinesFromFileName($fileName)
    {
        $fileHandle = fopen($fileName, 'r');

        $lines = [];
        while (false !== $line = fgets($fileHandle)) {
            $lines[] = $line;
        }

        fclose($fileHandle);

        return $lines;
    }

    public function getLinesFromFileName2($fileName)
    {
        $fileHandle = fopen($fileName, 'r');

        while (false !== $line = fgets($fileHandle)) {
            yield $line;
        }

        fclose($fileHandle);
    }

    public function getLinesFromFileName3($file)
    {
        return new LineIterator($file);
    }
}


class LineIterator implements \Iterator
{
    protected $fileHandle;
    protected $line;
    protected $i;

    public function __construct($fileName)
    {
        if (!$this->fileHandle = fopen($fileName, 'r')) {
            throw new \RuntimeException('Couldn\'t open file "' . $fileName . '"');
        }
    }

    public function rewind()
    {
        fseek($this->fileHandle, 0);

        $this->line = fgets($this->fileHandle);
        $this->i = 0;
    }

    public function valid()
    {
        return false !== $this->line;
    }

    public function current()
    {
        return $this->line;
    }

    public function key()
    {
        return $this->i;
    }

    public function next()
    {
        if (false !== $this->line) {
            $this->line = fgets($this->fileHandle);
            $this->i++;
        }
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }
}
