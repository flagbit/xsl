<?php
namespace Genkgo\Xsl\Integration\Xsl;

class ValueOfSeparator extends AbstractXslTest
{
    public function testSubstringBefore()
    {
        $this->assertEquals('xsl2,is,transpiled,by,genkgo/xsl', $this->transformFile('Stubs/Xsl/value-of-separator.xsl'));
    }
}
