<?php

/**
 * This file is part of the Pluralizer package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Propel\Pluralizer;

/**
 * Standard replacement English pluralizer class. Based on the links below
 *
 * @link http://kuwamoto.org/2007/12/17/improved-pluralizing-in-php-actionscript-and-ror/
 * @link http://blogs.msdn.com/dmitryr/archive/2007/01/11/simple-english-noun-pluralizer-in-c.aspx
 * @link http://api.cakephp.org/view_source/inflector/
 *
 * @author paul.hanssen
 * @author Cristiano Cinotti
 */
class EnglishPluralizer implements PluralizerInterface
{
    /**
     * @var array
     */
    protected $plural = [
        '(ind|vert)ex' => '\1ices',
        '(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us' => '\1i',
        '(buffal|tomat)o' => '\1oes',

        'x'  => 'xes',
        'ch' => 'ches',
        'sh' => 'shes',
        'ss' => 'sses',

        'ay' => 'ays',
        'ey' => 'eys',
        'iy' => 'iys',
        'oy' => 'oys',
        'uy' => 'uys',
        'y'  => 'ies',

        'ao' => 'aos',
        'eo' => 'eos',
        'io' => 'ios',
        'oo' => 'oos',
        'uo' => 'uos',
        'o'  => 'os',

        'us' => 'uses',

        'cis' => 'ces',
        'sis' => 'ses',
        'xis' => 'xes',

        'zoon' => 'zoa',

        'itis' => 'itis',
        'ois'  => 'ois',
        'pox'  => 'pox',
        'ox'   => 'oxes',

        'foot'  => 'feet',
        'goose' => 'geese',
        'tooth' => 'teeth',
        'quiz' => 'quizzes',
        'alias' => 'aliases',

        'alf'  => 'alves',
        'elf'  => 'elves',
        'olf'  => 'olves',
        'arf'  => 'arves',
        'nife' => 'nives',
        'life' => 'lives'
    ];

    protected $irregular = [
        'matrix' => 'matrices',
        'leaf'   => 'leaves',
        'loaf'   => 'loaves',
        'move'   => 'moves',
        'foot'   => 'feet',
        'goose'  => 'geese',
        'genus'  => 'genera',
        'sex'    => 'sexes',
        'ox'     => 'oxen',
        'child'  => 'children',
        'man'    => 'men',
        'tooth'  => 'teeth',
        'person' => 'people',
        'wife'   => 'wives',
        'mythos' => 'mythoi',
        'testis' => 'testes',
        'numen'  => 'numina',
        'quiz'   => 'quizzes',
        'alias'  => 'aliases',
    ];

    protected $uncountable = [
        'sheep',
        'fish',
        'deer',
        'series',
        'species',
        'money',
        'rice',
        'information',
        'equipment',
        'news',
        'people',
    ];

    /**
     * Generate a plural name based on the passed in root.
     *
     * @param  string $root The root that needs to be pluralized (e.g. Author)
     * @return string The plural form of $root (e.g. Authors).
     * @throws \InvalidArgumentException If the parameter is not a string.
     */
    public function getPluralForm($root)
    {
        if (!is_string($root)) {
            throw new \InvalidArgumentException("The pluralizer expects a string.");
        }

        if (in_array(strtolower($root), $this->uncountable)) {
            return $root;
        }

        if (null !== $replacement = $this->checkIrregularForm($root, $this->irregular)) {
            return $replacement;
        }

        if (null !== $replacement = $this->checkIrregularSuffix($root, $this->plural)) {
            return $replacement;
        }

        // fallback to naive pluralization
        return $root . 's';
    }

    /**
     * Generate a singular name based on the passed in root.
     *
     * @param  string $root The root that needs to be pluralized (e.g. Author)
     * @return string The singular form of $root (e.g. Authors).
     * @throws \InvalidArgumentException If the parameter is not a string.
     */
    public function getSingularForm($root)
    {
        if (!is_string($root)) {
            throw new \InvalidArgumentException("The pluralizer expects a string.");
        }

        if (in_array(strtolower($root), $this->uncountable)) {
            return $root;
        }

        if (null !== $replacement = $this->checkIrregularForm($root, array_flip($this->irregular))) {
            return $replacement;
        }

        if (null !== $replacement = $this->checkIrregularSuffix($root, $this->getSingularArray())) {
            return $replacement;
        }

        // fallback to naive singularization
        return substr($root, 0, -1);
    }

    /**
     * Pluralize/Singularize irregular forms.
     *
     * @param string $root The string to pluralize/singularize
     * @param array $irregular Array of irregular forms
     *
     * @return null|string
     */
    private function checkIrregularForm($root, $irregular)
    {
        foreach ($irregular as $pattern => $result) {
            $searchPattern = '/' . $pattern . '$/i';
            if ($root !== $replacement = preg_replace($searchPattern, $result, $root)) {
                // look at the first char and see if it's upper case
                // I know it won't handle more than one upper case char here (but I'm OK with that)
                if (preg_match('/^[A-Z]/', $root)) {
                    $replacement = ucfirst($replacement);
                }

                return $replacement;
            }
        }

        return null;
    }

    /**
     * @param string $root
     * @param array $irregular Array of irregular suffixes
     *
     * @return null|string
     */
    private function checkIrregularSuffix($root, $irregular)
    {
        foreach ($irregular as $pattern => $result) {
            $searchPattern = '/' . $pattern . '$/i';
            if ($root !== $replacement = preg_replace($searchPattern, $result, $root)) {
                return $replacement;
            }
        }

        return null;
    }

    /**
     * Flip the array of plural suffixes, to use it for singularize.
     *
     * @return array
     */
    private function getSingularArray()
    {
        $singular = array_flip($this->plural);
        $singular = array_slice($singular, 3);

        $reg = [
            '(ind|vert)ices' => '\1ex',
            '(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)i' => '\1us',
            '(buffal|tomat)oes' => '\1o'
        ];

        $singular = array_merge($reg, $singular);

        // We have an ambiguity: -xes is the plural form of -x or -xis. By now, we choose -x. Words with -xis suffix
        // should be added to the $irregular array.
        $singular['xes'] = 'x';

        return $singular;
    }
}
