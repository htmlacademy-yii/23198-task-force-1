<?php

namespace Taskforce\base\utils;

use SplFileObject;
use Taskforce\base\exceptions\OutFileException;
use Taskforce\base\exceptions\SourceFileException;


class CsvToSQLConverter
{
    private $_file;
    private $_tableName;
    private $_columns;
    private  $_fileObject;
    private $_result = [];

    /**
     * CsvToSQL constructor.
     * @param string $file
     * @param string $tableName
     */
    public function __construct(string $file, string $tableName)
    {
        $this->_file = $file;
        $this->_tableName = $tableName;

        if (!file_exists($this->_file)) {
            throw new SourceFileException("Файл не существует");
        }

        try {
            $this->_fileObject = new SplFileObject($this->_file);
        }catch (\RuntimeException $e) {
            throw new SourceFileException('Не удалось открыть файл');
        }

        $this->_fileObject->setFlags(SplFileObject::READ_AHEAD);
        $this->_fileObject->setFlags(SplFileObject::SKIP_EMPTY);
    }

    /**
     * @throws OutFileException
     * @throws SourceFileException
     */
    public function export() :void
    {
        $this->_columns = $this->getColumns();

        foreach ($this->readFile() as $line) {
            $this->_result[] = $line;
        }

        $this->save(__DIR__ . '/../../../data/' . $this->_tableName . '.sql');
    }

    /**
     * @return string
     */
    private function getColumns() : string
    {
        $cols = explode(',', trim($this->_fileObject->current()));

        $new_cols = array_map(function ($item){
            return "`$item`";
        }, $cols);

        return implode(',', $new_cols);
    }

    /**
     * @return iterable|null
     * @throws SourceFileException
     */
    private function readFile() :?iterable
    {
        $fileContent = null;
        try {
            while (!$this->_fileObject->eof()) {
                yield $this->_fileObject->fgetcsv();
            }
        }catch (\RuntimeException $e){
            throw new SourceFileException('Ошибка чтения файла');
        }

        return $fileContent;
    }

    /**
     * @param array $data
     * @return string
     */
    private function convertToSQL(array $data) :string
    {
        $sql = '';
        foreach ($data as $row) {
            if (!empty($row)){
            $sql .= 'INSERT INTO ' . $this->_tableName . ' (' . $this->_columns . ') VALUES (';
                $rows = array_map(function ($item){
                    return "'$item'";
                }, $row);
                $sql .= implode(',', $rows);
            $sql .= ');' . PHP_EOL;
            }
        }
        return $sql;
    }

    /**
     * @param string $name
     * @throws OutFileException
     */
    private function save(string $name) :void
    {
        try {
            $file = new SplFileObject($name, 'w');
        }catch (\RuntimeException $e){
            throw new OutFileException('Не удалось открыть файл на запись');
        }

        try {
            $file->fwrite($this->convertToSQL($this->_result));
        }catch (\RuntimeException $e){
            throw new OutFileException('Ошибка записи в файл');
        }

    }
}
