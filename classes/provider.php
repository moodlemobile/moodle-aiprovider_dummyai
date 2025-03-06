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

use core_ai\aiactions;
use core_ai\form\action_settings_form;

/**
 * Class provider.
 *
 * @package    aiprovider_dummyai
 * @copyright  2025 Pau Ferrer <pau@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider extends \core_ai\provider {

    /**
     * Get the list of actions that this provider supports.
     *
     * @return array An array of action class names.
     */
    public static function get_action_list(): array {
        return [
            \core_ai\aiactions\generate_text::class,
            \core_ai\aiactions\generate_image::class,
            \core_ai\aiactions\summarise_text::class,
        ];
    }

    #[\Override]
    public function is_request_allowed(aiactions\base $action): array|bool {
        return true;
    }

    /**
     * Get any action settings for this provider.
     *
     * @param string $action The action class name.
     * @param array $customdata The customdata for the form.
     * @return action_settings_form|bool The settings form for this action or false in no settings.
     */
    public static function get_action_settings(
        string $action,
        array $customdata = [],
    ): action_settings_form|bool {
        return false;
    }

    /**
     * Check this provider has the minimal configuration to work.
     *
     * @return bool Return true if configured.
     */
    public function is_provider_configured(): bool {
        return true;
    }
}
