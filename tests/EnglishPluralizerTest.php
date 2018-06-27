<?php

/**
 * This file is part of the Pluralizer package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Propel\Pluralizer\Tests;

use PHPUnit\Framework\TestCase;
use Propel\Pluralizer\EnglishPluralizer;

/**
 * Tests for the StandardEnglishPluralizer class
 *
 */
class EnglishPluralizerTest extends TestCase
{
    public function getPluralFormDataProvider()
    {
        return [
            ['', 's'],
            ['user', 'users'],
            ['users', 'userss'],
            ['User', 'Users'],
            ['sheep', 'sheep'],
            ['Sheep', 'Sheep'],
            ['wife', 'wives'],
            ['Wife', 'Wives'],
            ['country', 'countries'],
            ['Country', 'Countries'],
            ['Video', 'Videos'],
            ['video', 'videos'],
            ['Photo', 'Photos'],
            ['photo', 'photos'],
            ['Tomato', 'Tomatoes'],
            ['tomato', 'tomatoes'],
            ['Buffalo', 'Buffaloes'],
            ['buffalo', 'buffaloes'],
            ['typo', 'typos'],
            ['Typo', 'Typos'],
            ['apple', 'apples'],
            ['Apple', 'Apples'],
            ['Man', 'Men'],
            ['man', 'men'],
            ['numen', 'numina'],
            ['Numen', 'Numina'],
            ['bus', 'buses'],
            ['Bus', 'Buses'],
            ['news', 'news'],
            ['News', 'News'],
            ['food_menu', 'food_menus'],
            ['Food_menu', 'Food_menus'],
            ['quiz', 'quizzes'],
            ['Quiz', 'Quizzes'],
            ['alumnus', 'alumni'],
            ['Alumnus', 'Alumni'],
            ['vertex', 'vertices'],
            ['Vertex', 'Vertices'],
            ['matrix', 'matrices'],
            ['Matrix', 'Matrices'],
            ['index', 'indices'],
            ['Index', 'Indices'],
            ['alias', 'aliases'],
            ['Alias', 'Aliases'],
            ['bacillus', 'bacilli'],
            ['Bacillus', 'Bacilli'],
            ['cactus', 'cacti'],
            ['Cactus', 'Cacti'],
            ['focus', 'foci'],
            ['Focus', 'Foci'],
            ['fungus', 'fungi'],
            ['Fungus', 'Fungi'],
            ['nucleus', 'nuclei'],
            ['Nucleus', 'Nuclei'],
            ['radius', 'radii'],
            ['Radius', 'Radii'],
            ['people', 'people'],
            ['People', 'People'],
            ['glove', 'gloves'],
            ['Glove', 'Gloves'],
            ['crisis', 'crises'],
            ['Crisis', 'Crises'],
            ['tax', 'taxes'],
            ['Tax', 'Taxes'],
            ['Tooth', 'Teeth'],
            ['tooth', 'teeth'],
            ['Foot', 'Feet'],
        ];
    }

    public function providerForWrongType()
    {
        return [
            [null],
            [[1, 2, 3]],
            [245],
            [['apple' => 'fruit', 'tomato' => 'vegetables']],
            [new \StdClass()],
            [true],
            [false]
        ];
    }

    /**
     * @dataProvider getPluralFormDataProvider
     */
    public function testPluralForm($input, $output)
    {
        $pluralizer = new EnglishPluralizer();
        $this->assertEquals($output, $pluralizer->getPluralForm($input));
    }

    /**
     * @dataProvider providerForWrongType
     * @expectedException \InvalidArgumentException
     */
    public function testWrongTypeToPluralizeThrowsException($wrong)
    {
        $pluralizer = new EnglishPluralizer();
        $pluralizer->getPluralForm($wrong);
    }

    /**
     * @dataProvider getPluralFormDataProvider
     */
    public function testSingularForm($output, $input)
    {
        $pluralizer = new EnglishPluralizer();
        $this->assertEquals($output, $pluralizer->getSingularForm($input));
    }

    /**
     * @dataProvider providerForWrongType
     * @expectedException \InvalidArgumentException
     */
    public function testWrongTypeToSingularizeThrowsException($wrong)
    {
        $pluralizer = new EnglishPluralizer();
        $pluralizer->getSingularForm($wrong);
    }
}
