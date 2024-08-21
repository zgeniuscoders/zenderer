<?php

namespace Zgeniuscoders\Zenderer\Zenderer;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Zgeniuscoders\Zenderer\Zenderer\Exceptions\TemplateVariableTypeException;

class Zenderer
{
    private string $template;
    private array $data;

    public function renderer(string $path, array $data = [])
    {
        $this->data = $data;
        $this->template = $this->getContent($path);

        $this->renderTemplateVariables();

        $response = (new Response())
            ->withStatus(200)
            ->withHeader('Content-Type', 'text/html');

        $st = $response->getBody();
        $st->write($this->template);


        $this->send($response);
    }

    private function send(ResponseInterface $response)
    {
        $http_line = sprintf(
            'HTTP/%s %s %s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            $response->getReasonPhrase()
        );

        header($http_line, true, $response->getStatusCode());

        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header("$name: $value", false);
            }
        }

        $stream = $response->getBody();

        if ($stream->isSeekable()) {
            $stream->rewind();
        }

        while (!$stream->eof()) {
            echo $stream->read(1024 * 8);
        }
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
    private function renderTemplateVariables(): void
    {
        $this->template = preg_replace_callback('/\{\{(\w+)\}\}/', [$this, 'replaceContent'], $this->template);
    }

    private function replaceContent($match)
    {
        if ($match[1] === "data") {
            throw new TemplateVariableTypeException("Array variables are not supported for template replacement. Please use scalar variables only.");
        } else {
            return $this->data[$match[1]];
        }
    }
}
