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
 * Class process text explanations.
 *
 * @package    aiprovider_dummyai
 * @copyright  2025 Pau Ferrer <pau@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class process_explain_text extends process_generate_text {

    #[\Override]
    protected function get_endpoint(): UriInterface {
        return new Uri('https://chiquito-ipsum.netlify.app/');
    }

    #[\Override]
    protected function create_request_object(): RequestInterface {
        return new Request(
            method: 'GET',
            uri: '',
            headers: [
                'Content-Type' => 'text/plain',
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

        return [
            'success' => true,
            'generatedcontent' => $responsebody,
        ];
    }

}
