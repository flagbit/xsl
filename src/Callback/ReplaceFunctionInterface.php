<?php
namespace Genkgo\Xsl\Callback;
use Genkgo\Xsl\TransformationContext;
use Genkgo\Xsl\Xpath\Lexer;

/**
 * Interface ReplaceFunctionInterface
 * @package Genkgo\Xsl\Callback
 */
interface ReplaceFunctionInterface
{
    /**
     * @param Lexer $lexer
     * @return array|string[]
     */
    public function replace(Lexer $lexer);
}
