<?php
namespace Genkgo\Xsl\Stubs\Extension;

use Genkgo\Xsl\Callback\ClosureCallback;
use Genkgo\Xsl\Callback\ClosureFunction;
use Genkgo\Xsl\Callback\ContextFunction;
use Genkgo\Xsl\Callback\ReturnPhpScalarFunction;
use Genkgo\Xsl\Callback\StaticFunction;
use Genkgo\Xsl\Callback\StringFunction;
use Genkgo\Xsl\Util\FunctionMap;
use Genkgo\Xsl\Util\TransformerCollection;
use Genkgo\Xsl\XmlNamespaceInterface;

class MyExtension implements XmlNamespaceInterface
{
    const URI = 'https://github.com/genkgo/xsl/tree/master/tests/Stubs/Extension/MyExtension';

    /**
     * @param ...$args
     * @return string
     */
    public static function helloWorld(...$args)
    {
        return 'Hello World was called and received ' . count($args) . ' arguments!';
    }

    /**
     * @param TransformerCollection $transformers
     * @param FunctionMap $functions
     * @return void
     */
    public function register(TransformerCollection $transformers, FunctionMap $functions)
    {
        (new StaticFunction(
            self::URI . ':hello-world', new StringFunction([static::class, 'helloWorld']))
        )->register($functions);

        (new ClosureFunction(
            self::URI . ':hello-earth',
            new ContextFunction(self::URI . ':hello-earth'),
            function ($arguments) {
                return count($arguments);
            }
        ))->register($functions);
    }
}
