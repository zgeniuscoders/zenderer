<?php

namespace Zgeniuscoders\Zenderer\Zenderer;

class ConditionalTemplateRenderer
{

    private array $logicalOperators = [
        ">",
        "<",
        ">=",
        "<=",
        "==",
        "!=",
        "===",
        "!==",
        "&&",
        "||",
        "!",
        "AND",
        "OR",
        "XOR",
        "and",
        "or",
        "xor",
    ];

    public function __construct(private string &$templete) {}

    /**
     * Replaces if-elseif-elseif-...-else-endif statements in the template content.
     *
     * This function takes the template content as a reference and replaces the if-elseif-elseif-...-else-endif
     * statement syntax `{% if condition %} ... {% elseif condition %} ... {% elseif condition %} ... {% else %} ... {% endif %}`
     * with the corresponding PHP syntax.
     *
     * The `elseif` blocks can be repeated multiple times, and the `else` block is optional.
     *
     * @param string $content The template content to be modified.
     * @return void
     */
    private function replaceIfElseStatement(): void
    {
        $pattern = '/{%\s*if\s+(.*?)\s*%}/s';

        $result = preg_replace_callback($pattern, [$this, 'check'], $this->templete);
    }


    private function replaceContent($matches)
    {
        // Vérifier la condition
        $ex = explode(" ", $matches[1]);

        echo "<pre>";
        var_dump($ex);
        echo "<pre/>";
    }
}
