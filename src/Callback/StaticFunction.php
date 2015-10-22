<?php
namespace Genkgo\Xsl\Callback;

use Genkgo\Xsl\Util\FunctionMap;
use Genkgo\Xsl\Xpath\Lexer;

/**
 * Interface FunctionCall
 * @package Genkgo\Xsl\Callback
 */
final class StaticFunction implements FunctionInterface, ReplaceFunctionInterface
{

    private $name;
    private $replacer;

    public function __construct ($name, ReplaceFunctionInterface $replacer) {
        $this->name = $name;
        $this->replacer = $replacer;
    }


    /**
     * @param FunctionMap $functionMap
     * @return void
     */
    public function register (FunctionMap $functionMap) {
        $functionMap->set($this->name, $this);
    }

    /**
     * @param Lexer $lexer
     * @return array|string[]
     */
    public function replace(Lexer $lexer)
    {
        return $this->replacer->replace($lexer);
    }
}
