<?php

namespace Zgeniuscoders\Zenderer;

class Zenderer
{

    private string $path;
    private array $data;


    public function renderer(string $path, array $data = [])
    {
        $content = $this->getContent($path);
        $this->renderTemplateVariables($content);

        // Extract variables
        extract($data);

        // Execute the PHP code
        ob_start();
        eval('?>' . $content . '<?php');
        return ob_get_clean();
    }

    private function getContent(string $template)
    {
        return file_get_contents($template);
    }

    /**
     * Replaces template placeholders with their corresponding PHP echo statements.
     *
     * This function takes a string containing template placeholders in the format `{{variable}}`,
     * and replaces them with the corresponding PHP code to echo the variable's value.
     *
     * @param string $content The content string to be processed.
     * @return void The function modifies the `$content` parameter directly, no return value.
     */
    private function renderTemplateVariables(string &$content): void
    {
        $content = preg_replace('/\{\{(\w+)\}\}/', '<?php echo $\\1; ?>', $content);
    }


    private function replaceIfStatement(string &$content): void
    {
        $content = preg_replace(
            '/{%\s*if\s*(\w+)\s*%}(.*?){%\s*endif\s*%}/s',
            '<?php if ($\\1) : ?>\$2<?php endif; ?>',
            $content
        );
    }

    private function replaceIfElseStatement(string &$content): void
    {
        $content = preg_replace(
            '/{%\s*if\s*(\w+)\s*%}(.*?){%\s*else\s*%}(.*?){%\s*endif\s*%}/s',
            '<?php if ($\\1) : ?>\$2<?php else : ?>\$3<?php endif; ?>',
            $content
        );
    }

    private function replaceWhileLoops(string &$content): void
    {
        $content = preg_replace(
            '/{%\s*while\s*(\w+)\s*%}(.*?){%\s*endwhile\s*%}/s',
            '<?php while ($\\1) : ?>\$2<?php endwhile; ?>',
            $content
        );
    }

    private function replaceDoWhileLoops(string &$content): void
    {
        $content = preg_replace(
            '/{%\s*do\s*%}(.*?){%\s*while\s*(\w+)\s*%}/s',
            '<?php do : ?>\$1<?php while ($\\2); ?>',
            $content
        );
    }

    private function replaceForLoops(string &$content): void
    {
        $content = preg_replace(
            '/{%\s*for\s*(\w+)\s*in\s*(\w+)\s*%}(.*?){%\s*endfor\s*%}/s',
            '<?php for ($\\1 = 0; $\\1 < count($\\2); $\\1++) : ?>\$3<?php endfor; ?>',
            $content
        );
    }

    private function replaceForEachLoops(string &$content): void
    {
        $content = preg_replace(
            '/{%\s*for\s*(\w+)\s*,\s*(\w+)\s*in\s*(\w+)\s*%}(.*?){%\s*endfor\s*%}/s',
            '<?php foreach ($\\3 as $\\1 => $\\2) : ?>\$4<?php endforeach; ?>',
            $content
        );
    }
}
