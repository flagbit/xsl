<?php
namespace Genkgo\Xsl\Xpath;

use Genkgo\Xsl\Callback\ObjectFunction;
use Genkgo\Xsl\Callback\ReturnPhpScalarFunction;
use Genkgo\Xsl\Callback\ReturnXsScalarFunction;
use Genkgo\Xsl\Callback\ReturnXsSequenceFunction;
use Genkgo\Xsl\Callback\StaticFunction;
use Genkgo\Xsl\Callback\StringFunction;
use Genkgo\Xsl\Util\FunctionMap;
use Genkgo\Xsl\Util\TransformerCollection;
use Genkgo\Xsl\XmlNamespaceInterface;
use Genkgo\Xsl\Xpath\Functions\Aggregation;
use Genkgo\Xsl\Xpath\Functions\Date;
use Genkgo\Xsl\Xpath\Functions\Math;
use Genkgo\Xsl\Xpath\Functions\Sequence;
use Genkgo\Xsl\Xpath\Functions\Text;

class XmlPath implements XmlNamespaceInterface
{
    const URI = '';

    /**
     * @param TransformerCollection $transformers
     * @param FunctionMap $functions
     * @return void
     */
    public function register(TransformerCollection $transformers, FunctionMap $functions)
    {
        $this->registerStringFunctions([
            'abs', 'ceiling', 'floor', 'round', 'round-half-to-even'
        ], $functions, Math::class);

        $this->registerStringFunctions([
            'starts-with', 'ends-with', 'index-of', 'matches', 'lower-case',
            'upper-case', 'translate', 'substring-after', 'substring-before', 'replace'
        ], $functions, Text::class);

        $this->registerAggregationFunctions(['avg', 'max', 'min'], $functions);

        (new StaticFunction(
            'string-join',
            new ObjectFunction([Text::class, 'stringJoin'])
        ))->register($functions);

        (new StaticFunction(
            'tokenize',
            new ReturnXsSequenceFunction(new ObjectFunction([Text::class, 'tokenize']))
        ))->register($functions);

        (new StaticFunction(
            'remove',
            new ReturnXsSequenceFunction(new ObjectFunction([Sequence::class, 'remove']))
        ))->register($functions);
        (new StaticFunction(
            'subsequence',
            new ReturnXsSequenceFunction(new ObjectFunction([Sequence::class, 'subsequence']))
        ))->register($functions);
        (new StaticFunction(
            'reverse',
            new ReturnXsSequenceFunction(new ObjectFunction([Sequence::class, 'reverse']))
        ))->register($functions);
        (new StaticFunction(
            'insert-before',
            new ReturnXsSequenceFunction(new ObjectFunction([Sequence::class, 'insertBefore']))
        ))->register($functions);

        (new StaticFunction(
            'current-time',
            new ReturnXsScalarFunction(new ObjectFunction([Date::class, 'currentTime']), 'time')
        ))->register($functions);
        (new StaticFunction(
            'current-date',
            new ReturnXsScalarFunction(new ObjectFunction([Date::class, 'currentDate']), 'date')
        ))->register($functions);
        (new StaticFunction(
            'current-dateTime',
            new ReturnXsScalarFunction(new ObjectFunction([Date::class, 'currentDateTime']), 'dateTime')
        ))->register($functions);
    }

    private function registerStringFunctions(array $list, FunctionMap $functions, $className)
    {
        foreach ($list as $functionName) {
            (new StaticFunction(
                $functionName,
                new StringFunction([$className, $functionName], true)
            ))->register($functions);
        }
    }

    private function registerAggregationFunctions(array $list, FunctionMap $functions)
    {
        foreach ($list as $functionName) {
            (new StaticFunction(
                $functionName,
                new ObjectFunction([Aggregation::class, $functionName], true)
            ))->register($functions);
        }
    }
}
