<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace aiprovider_dummyai;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class process text summarisation.
 *
 * @package    aiprovider_dummyai
 * @copyright  2025 Pau Ferrer <pau@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class process_summarise_text extends process_generate_text {

    #[\Override]
    protected function get_endpoint(): UriInterface {
        return new Uri('https://raw.githubusercontent.com/agandia9/RajoyIpsum/refs/heads/master/src/data/data.json');
    }

    /**
     * This function gets random lines from the content.

    #[\Override]
    protected function query_ai_api(): array {
        $content = $this->action->get_configuration('prompttext');

        // Select random lines on the content.
        $content = explode("\n", $content);
        $firstline = rand(0, count($content) - 1);
        $lastline = rand($firstline, count($content) - 1);
        $content = array_slice($content, $firstline, $lastline);

        return [
            'success' => true,
            'generatedcontent' => implode("\n", $content),
        ];
    }*/

    #[\Override]
    protected function create_request_object(): RequestInterface {
        return new Request(
            method: 'GET',
            uri: '',
            headers: [
                'Content-Type' => 'application/json',
            ],
        );
    }

    /**
     * Handle a successful response from the external AI api.
     *
     * @param ResponseInterface $response The response object.
     * @return array The response.
     */
    protected function handle_api_success(ResponseInterface $response): array {
        $responsebody = $response->getBody();
        $bodyobj = json_decode($responsebody->getContents());

        // bodyobj is an away get one of the elements.
        $content = $bodyobj[array_rand($bodyobj)];

        return [
            'success' => true,
            'generatedcontent' => $content->text,
        ];
    }

}
