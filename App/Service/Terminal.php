<?php

namespace App\Service;

class Terminal
{
    public const ARG_INPUT = 'input';
    public const ARG_OUTPUT = 'output';
    public const ARG_HELP = 'help';

    /** @var array */
    private $rawArgs;

    /** @var array */
    private $terminalArgs = [];

    /** @var string */
    private $input;

    /** @var string */
    private $output;

    public function __construct(array $rawArgs)
    {
        $this->rawArgs = $rawArgs;
    }

    /**
     * @throws TerminalException
     */
    public function start() : void
    {
        if (count($this->rawArgs) < 2) {
            throw new TerminalException("You should pass at least 1 parameter, see --help");
        }

        $this->parseArgs();

        if (key_exists(self::ARG_HELP, $this->terminalArgs)) {
            $this->display($this->getHelp())->terminate();
        }

        if (!key_exists(self::ARG_INPUT, $this->terminalArgs)) {
            throw new TerminalException("Wrong arguments, see --help");
        }

        $this->input = $this->terminalArgs[self::ARG_INPUT];
        if (key_exists(self::ARG_OUTPUT, $this->terminalArgs)) {
            $this->output = $this->terminalArgs[self::ARG_OUTPUT];
        } else {
            $this->output = 'output';
        }
    }

    public function display(string $msg) : self
    {
        echo $msg;
        return $this;
    }

    public function terminate() : void
    {
        exit(0);
    }

    /**
     * @return void
     */
    private function parseArgs() : void
    {
        array_shift($this->rawArgs);
        foreach ($this->rawArgs as $arg) {
            $exploded = explode("=", substr($arg, 2, strlen($arg)));
            $this->terminalArgs[$exploded[0]] = $exploded[1];
        }
    }

    private function getHelp() : string
    {
        return "Available parameters:
                \r\t input - required, path to csv file
                \r\t output - optional, path to output json file, default output.json
                \r\n\t Example: php gentree.php --input=myfileinput.csv --output=myfileoutput.json";
    }

    /**
     * @return string
     */
    public function getInput(): string
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }
}