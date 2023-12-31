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

/**
 * Custom space icon system
 *
 * @package    theme_boosted
 * @copyright  2022-2023 koditik.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_boosted\output;

use renderer_base;
use pix_icon;

class icon_system_fontawesome extends \core\output\icon_system_fontawesome {
    /**
     * Change the core icon map.
     *
     * @return Array replaced icons.
     */
    public function get_core_icon_map() {
        $iconmap = parent::get_core_icon_map();

        $iconmap['atto_collapse:icon'] = 'fa fa-bars';
        $iconmap['atto_h5p:icon'] = 'fa fa-laptop-code';
        $iconmap['atto_recordrtc:i/audiortc'] = 'fa fa-microphone';
        $iconmap['atto_recordrtc:i/videortc'] = 'fa fa-file-video';
        $iconmap['core:a/add_file'] = 'fa fa-file';
        $iconmap['core:a/create_folder'] = 'fa fa-folder-plus';
        $iconmap['core:a/download_all'] = 'fa fa-download';
        $iconmap['core:a/help'] = 'fa fa-question-circle';
        $iconmap['core:a/logout'] = 'fa fa-sign-out-alt';
        $iconmap['core:a/refresh'] = 'fa fa-redo-alt';
        $iconmap['core:a/search'] = 'fa fa-search';
        $iconmap['core:a/setting'] = 'fa fa-cog';
        $iconmap['core:a/view_icon_active'] = 'fa fa-th';
        $iconmap['core:a/view_list_active'] = 'fa fa-list';
        $iconmap['core:a/view_tree_active'] = 'fa fa-folder';
        $iconmap['core:b/bookmark-new'] = 'fa fa-bookmark';
        $iconmap['core:b/document-edit'] = 'fa fa-edit';
        $iconmap['core:b/document-new'] = 'fa fa-file';
        $iconmap['core:b/document-properties'] = 'fa fa-info-circle';
        $iconmap['core:b/edit-copy'] = 'fa fa-copy';
        $iconmap['core:b/edit-delete'] = 'fa fa-trash';
        $iconmap['core:docs'] = 'fa fa-info-circle';
        $iconmap['core:e/abbr'] = 'fa fa-comment-alt';
        $iconmap['core:e/absolute'] = 'fa fa-crosshairs';
        $iconmap['core:e/accessibility_checker'] = 'fa fa-universal-access';
        $iconmap['core:e/acronym'] = 'fa fa-comment-alt';
        $iconmap['core:e/advance_hr'] = 'fa fa-arrows-alt-h';
        $iconmap['core:e/align_center'] = 'fa fa-align-center';
        $iconmap['core:e/align_left'] = 'fa fa-align-left';
        $iconmap['core:e/align_right'] = 'fa fa-align-right';
        $iconmap['core:e/anchor'] = 'fa fa-chain';
        $iconmap['core:e/backward'] = 'fa fa-undo-alt';
        $iconmap['core:e/bold'] = 'fa fa-bold';
        $iconmap['core:e/bullet_list'] = 'fa fa-list-ul';
        $iconmap['core:e/cancel_solid_circle'] = 'fa fa-times-circle';
        $iconmap['core:e/cancel'] = 'fa fa-times';
        $iconmap['core:e/cell_props'] = 'fa fa-info-circle';
        $iconmap['core:e/cite'] = 'fa fa-quote-right';
        $iconmap['core:e/cleanup_messy_code'] = 'fa fa-eraser';
        $iconmap['core:e/clear_formatting'] = 'fa fa-i-cursor';
        $iconmap['core:e/copy'] = 'fa fa-clone';
        $iconmap['core:e/cut'] = 'fa fa-scissors';
        $iconmap['core:e/decrease_indent'] = 'fa fa-outdent';
        $iconmap['core:e/delete_col'] = 'fa fa-minus-square';
        $iconmap['core:e/delete_row'] = 'fa fa-minus-square';
        $iconmap['core:e/delete_table'] = 'fa fa-minus-square';
        $iconmap['core:e/delete'] = 'fa fa-minus-square';
        $iconmap['core:e/document_properties'] = 'fa fa-info-circle';
        $iconmap['core:e/emoticons'] = 'fa fa-smile';
        $iconmap['core:e/file-text'] = 'fa fa-file-alt';
        $iconmap['core:e/find_replace'] = 'fa fa-search-plus';
        $iconmap['core:e/forward'] = 'fa fa-arrow-right';
        $iconmap['core:e/fullpage'] = 'fa fa-arrows-alt';
        $iconmap['core:e/fullscreen'] = 'fa fa-arrows-alt';
        $iconmap['core:e/help'] = 'fa fa-question-circle';
        $iconmap['core:e/increase_indent'] = 'fa fa-indent';
        $iconmap['core:e/insert_col_after'] = 'fa fa-columns';
        $iconmap['core:e/insert_col_before'] = 'fa fa-columns';
        $iconmap['core:e/insert_date'] = 'fa fa-calendar-alt';
        $iconmap['core:e/insert_edit_image'] = 'fa fa-image';
        $iconmap['core:e/insert_edit_link'] = 'fa fa-link';
        $iconmap['core:e/insert_edit_video'] = 'fa fa-file-video';
        $iconmap['core:e/insert_file'] = 'fa fa-hdd';
        $iconmap['core:e/insert_horizontal_ruler'] = 'fa fa-arrows-alt-h';
        $iconmap['core:e/insert_nonbreaking_alpha'] = 'fa fa-square';
        $iconmap['core:e/insert_page_break'] = 'fa fa-window-minimize';
        $iconmap['core:e/insert_row_after'] = 'fa fa-plus-square';
        $iconmap['core:e/insert_row_before'] = 'fa fa-plus-square';
        $iconmap['core:e/insert_time'] = 'fa fa-clock';
        $iconmap['core:e/insert'] = 'fa fa-plus-square';
        $iconmap['core:e/italic'] = 'fa fa-italic';
        $iconmap['core:e/justify'] = 'fa fa-align-justify';
        $iconmap['core:e/layers_over'] = 'fa fa-arrow-alt-circle-up';
        $iconmap['core:e/layers_under'] = 'fa fa-stream';
        $iconmap['core:e/layers'] = 'fa fa-window-restore';
        $iconmap['core:e/left_to_right'] = 'fa fa-chevron-right';
        $iconmap['core:e/manage_files'] = 'fa fa-cog';
        $iconmap['core:e/math'] = 'fa fa-calculator';
        $iconmap['core:e/merge_cells'] = 'fa fa-compress';
        $iconmap['core:e/new_document'] = 'fa fa-file';
        $iconmap['core:e/numbered_list'] = 'fa fa-list-ol';
        $iconmap['core:e/page_break'] = 'fa fa-window-minimize';
        $iconmap['core:e/paste_text'] = 'fa fa-clipboard';
        $iconmap['core:e/paste_word'] = 'fa fa-clipboard';
        $iconmap['core:e/paste'] = 'fa fa-clipboard';
        $iconmap['core:e/prevent_autolink'] = 'fa fa-exclamation-triangle';
        $iconmap['core:e/preview'] = 'fa fa-search-plus';
        $iconmap['core:e/print'] = 'fa fa-print';
        $iconmap['core:e/question'] = 'fa fa-question-circle';
        $iconmap['core:e/redo'] = 'fa fa-redo-alt';
        $iconmap['core:e/remove_link'] = 'fa fa-unlink';
        $iconmap['core:e/remove_page_break'] = 'fa fa-remove';
        $iconmap['core:e/resize'] = 'fa fa-expand';
        $iconmap['core:e/restore_draft'] = 'fa fa-undo-alt';
        $iconmap['core:e/restore_last_draft'] = 'fa fa-undo-alt';
        $iconmap['core:e/right_to_left'] = 'fa fa-chevron-left';
        $iconmap['core:e/row_props'] = 'fa fa-info-circle';
        $iconmap['core:e/save'] = 'fa fa-save';
        $iconmap['core:e/screenreader_helper'] = 'fa fa-braille';
        $iconmap['core:e/search'] = 'fa fa-search';
        $iconmap['core:e/select_all'] = 'fa fa-arrows-alt-h';
        $iconmap['core:e/show_invisible_characters'] = 'fa fa-eye-slash';
        $iconmap['core:e/source_code'] = 'fa fa-code';
        $iconmap['core:e/special_character'] = 'fa fa-edit';
        $iconmap['core:e/spellcheck'] = 'fa fa-check';
        $iconmap['core:e/split_cells'] = 'fa fa-columns';
        $iconmap['core:e/strikethrough'] = 'fa fa-strikethrough';
        $iconmap['core:e/styleparagraph'] = 'fa fa-font';
        $iconmap['core:e/styleprops'] = 'fa fa-info-circle';
        $iconmap['core:e/subscript'] = 'fa fa-subscript';
        $iconmap['core:e/superscript'] = 'fa fa-superscript';
        $iconmap['core:e/table_props'] = 'fa fa-table';
        $iconmap['core:e/table'] = 'fa fa-table';
        $iconmap['core:e/template'] = 'fa fa-sticky-note';
        $iconmap['core:e/text_color_picker'] = 'fa fa-paint-brush';
        $iconmap['core:e/text_color'] = 'fa fa-paint-brush';
        $iconmap['core:e/text_highlight_picker'] = 'fa fa-lightbulb';
        $iconmap['core:e/text_highlight'] = 'fa fa-lightbulb';
        $iconmap['core:e/tick'] = 'fa fa-check';
        $iconmap['core:e/toggle_blockquote'] = 'fa fa-quote-left';
        $iconmap['core:e/underline'] = 'fa fa-underline';
        $iconmap['core:e/undo'] = 'fa fa-undo-alt';
        $iconmap['core:e/visual_aid'] = 'fa fa-universal-access';
        $iconmap['core:e/visual_blocks'] = 'fa fa-audio-description';
        $iconmap['core:help'] = 'fa fa-question-circle text-muted';
        $iconmap['core:i/addblock'] = 'fa fa-plus-square';
        $iconmap['core:i/assignroles'] = 'fa fa-user-plus';
        $iconmap['core:i/backup'] = 'fa fa-file-archive';
        $iconmap['core:i/badge'] = 'fa fa-trophy';
        $iconmap['core:i/breadcrumbdivider'] = 'fa fa-caret-right';
        $iconmap['core:i/bullhorn'] = 'fa fa-bullhorn mr-2 mb-2';
        $iconmap['core:i/calc'] = 'fa fa-calculator';
        $iconmap['core:i/calendar'] = 'fa fa-calendar-alt';
        $iconmap['core:i/calendareventdescription'] = 'fa fa-align-left';
        $iconmap['core:i/calendareventtime'] = 'fa fa-clock';
        $iconmap['core:i/categoryevent'] = 'fa fa-book';
        $iconmap['core:i/caution'] = 'fa fa-exclamation-triangle text-danger';
        $iconmap['core:i/checked'] = 'fa fa-check';
        $iconmap['core:i/checkedcircle'] = 'fa fa-check-circle';
        $iconmap['core:i/checkpermissions'] = 'fa fa-lock-open';
        $iconmap['core:i/cohort'] = 'fa fa-users';
        $iconmap['core:i/competencies'] = 'fa fa-check';
        $iconmap['core:i/completion_self'] = 'fa fa-user-circle';
        $iconmap['core:i/contentbank'] = 'fa fa-box-open';
        $iconmap['core:i/course'] = 'fa fa-graduation-cap';
        $iconmap['core:i/courseevent'] = 'fa fa-graduation-cap';
        $iconmap['core:i/dashboard'] = 'fa fa-columns';
        $iconmap['core:i/db'] = 'fa fa-database';
        $iconmap['core:i/delete'] = 'fa fa-trash';
        $iconmap['core:i/down'] = 'fa fa-arrow-down';
        $iconmap['core:i/dragdrop'] = 'fa fa-arrows-alt';
        $iconmap['core:i/duration'] = 'fa fa-clock';
        $iconmap['core:i/edit'] = 'fa fa-edit';
        $iconmap['core:i/email'] = 'fa fa-envelope';
        $iconmap['core:i/emojicategoryactivities'] = 'fa fa-futbol';
        $iconmap['core:i/emojicategoryanimalsnature'] = 'fa fa-leaf';
        $iconmap['core:i/emojicategoryflags'] = 'fa fa-flag-usa';
        $iconmap['core:i/emojicategoryfooddrink'] = 'fa fa-utensils';
        $iconmap['core:i/emojicategoryobjects'] = 'fa fa-lightbulb';
        $iconmap['core:i/emojicategoryrecent'] = 'fa fa-history';
        $iconmap['core:i/emojicategorysmileyspeople'] = 'fa fa-smile';
        $iconmap['core:i/emojicategorysymbols'] = 'fa fa-heart';
        $iconmap['core:i/emojicategorytravelplaces'] = 'fa fa-plane';
        $iconmap['core:i/empty'] = 'fa fa-folder';
        $iconmap['core:i/enrolmentsuspended'] = 'fa fa-pause';
        $iconmap['core:i/enrolusers'] = 'fa fa-user-plus';
        $iconmap['core:i/expired'] = 'fa fa-exclamation-triangle text-danger';
        $iconmap['core:i/export'] = 'fa fa-download';
        $iconmap['core:i/files'] = 'fa fa-hdd';
        $iconmap['core:i/filter'] = 'fa fa-filter';
        $iconmap['core:i/flagged'] = 'fa fa-flag-checkered';
        $iconmap['core:i/folder'] = 'fa fa-folder';
        $iconmap['core:i/grade_correct'] = 'fa fa-check text-success';
        $iconmap['core:i/grade_incorrect'] = 'fa fa-times text-danger';
        $iconmap['core:i/grade_partiallycorrect'] = 'fa fa-check-square';
        $iconmap['core:i/grades'] = 'fa fa-book-open';
        $iconmap['core:i/grading'] = 'fa fa-marker';
        $iconmap['core:i/gradingnotifications'] = 'fa fa-bell';
        $iconmap['core:i/group'] = 'fa fa-users';
        $iconmap['core:i/groupevent'] = 'fa fa-users';
        $iconmap['core:i/groupn'] = 'fa fa-users-cog text-danger';
        $iconmap['core:i/groups'] = 'fa fa-users-cog';
        $iconmap['core:i/groupv'] = 'fa fa-users';
        $iconmap['core:i/hide'] = 'fa fa-eye';
        $iconmap['core:i/hierarchylock'] = 'fa fa-lock';
        $iconmap['core:i/home'] = 'fa fa-home';
        $iconmap['core:i/import'] = 'fa fa-arrow-alt-circle-up';
        $iconmap['core:i/info'] = 'fa fa-info-circle';
        $iconmap['core:i/invalid'] = 'fa fa-times text-danger';
        $iconmap['core:i/item'] = 'fa fa-circle';
        $iconmap['core:i/loading_small'] = 'fa fa-circle-notch fa-spin';
        $iconmap['core:i/loading'] = 'fa fa-circle-notch fa-spin';
        $iconmap['core:i/location'] = 'fa fa-map-marker-alt';
        $iconmap['core:i/lock'] = 'fa fa-lock';
        $iconmap['core:i/lock'] = 'fa fa-lock';
        $iconmap['core:i/log'] = 'fa fa-list-alt';
        $iconmap['core:i/mahara_host'] = 'fa fa-id-badge';
        $iconmap['core:i/manual_item'] = 'fa fa-square';
        $iconmap['core:i/marked'] = 'fa fa-circle';
        $iconmap['core:i/marker'] = 'fa fa-highlighter';
        $iconmap['core:i/mean'] = 'fa fa-calculator';
        $iconmap['core:i/menu'] = 'fa fa-list-alt';
        $iconmap['core:i/menubars'] = 'fa fa-menu';
        $iconmap['core:i/mnethost'] = 'fa fa-external-link';
        $iconmap['core:i/moodle_host'] = 'fa fa-graduation-cap';
        $iconmap['core:i/moremenu'] = 'fa fa-ellipsis-h';
        $iconmap['core:i/move_2d'] = 'fa fa-arrows-alt';
        $iconmap['core:i/navigationitem'] = 'fa fa-folder';
        $iconmap['core:i/navigationitem'] = 'fa fa-folder';
        $iconmap['core:i/ne_red_mark'] = 'fa fa-remove';
        $iconmap['core:i/new'] = 'fa fa-bolt';
        $iconmap['core:i/news'] = 'fa fa-newspaper';
        $iconmap['core:i/next'] = 'fa fa-arrow-right';
        $iconmap['core:i/nosubcat'] = 'fa fa-plus-square';
        $iconmap['core:i/notifications'] = 'fa fa-bell';
        $iconmap['core:i/open'] = 'fa fa-folder-open';
        $iconmap['core:i/otherevent'] = 'fa fa-neuter';
        $iconmap['core:i/outcomes'] = 'fa fa-tasks';
        $iconmap['core:i/payment'] = 'fa fa-money';
        $iconmap['core:i/permissionlock'] = 'fa fa-lock';
        $iconmap['core:i/permissions'] = 'fa fa-edit';
        $iconmap['core:i/persona_sign_in_black'] = 'fa fa-male';
        $iconmap['core:i/portfolio'] = 'fa fa-id-badge';
        $iconmap['core:i/preview'] = 'fa fa-search-plus';
        $iconmap['core:i/previous'] = 'fa fa-arrow-left';
        $iconmap['core:i/privatefiles'] = 'fa fa-hdd';
        $iconmap['core:i/progressbar'] = 'fa fa-spinner fa-spin';
        $iconmap['core:i/publish'] = 'fa fa-share';
        $iconmap['core:i/questions'] = 'fa fa-question-circle';
        $iconmap['core:i/reload'] = 'fa fa-redo-alt';
        $iconmap['core:i/report'] = 'fa fa-chart-area';
        $iconmap['core:i/repository'] = 'fa fa-hdd-o';
        $iconmap['core:i/restore'] = 'fa fa-arrow-alt-circle-up';
        $iconmap['core:i/return'] = 'fa fa-undo-alt';
        $iconmap['core:i/risk_config'] = 'fa fa-user-cog';
        $iconmap['core:i/risk_dataloss'] = 'fa fa-exclamation-triangle text-danger';
        $iconmap['core:i/risk_personal'] = 'fa fa-user-shield';
        $iconmap['core:i/risk_spam'] = 'fa fa-mail-bulk';
        $iconmap['core:i/risk_xss'] = 'fa fa-exclamation-triangle text-danger';
        $iconmap['core:i/role'] = 'fa fa-user-md';
        $iconmap['core:i/rss'] = 'fa fa-rss';
        $iconmap['core:i/rsssitelogo'] = 'fa fa-graduation-cap';
        $iconmap['core:i/scales'] = 'fa fa-balance-scale';
        $iconmap['core:i/scheduled'] = 'fa fa-calendar-check-o';
        $iconmap['core:i/search'] = 'fa fa-search';
        $iconmap['core:i/section'] = 'fa fa-folder';
        $iconmap['core:i/sendmessage'] = 'fa fa-paper-plane';
        $iconmap['core:i/settings'] = 'fa fa-cog';
        $iconmap['core:i/show'] = 'fa fa-eye-slash';
        $iconmap['core:i/siteevent'] = 'fa fa-globe-americas';
        $iconmap['core:i/star-half'] = 'fa fa-star-half-alt';
        $iconmap['core:i/star-o'] = 'fa fa-star';
        $iconmap['core:i/star-rating'] = 'fa fa-star';
        $iconmap['core:i/star'] = 'fa fa-star';
        $iconmap['core:i/stats'] = 'fa fa-line-chart';
        $iconmap['core:i/switch'] = 'fa fa-exchange';
        $iconmap['core:i/switchrole'] = 'fa fa-user-secret';
        $iconmap['core:i/trash'] = 'fa fa-trash';
        $iconmap['core:i/twoway'] = 'fa fa-arrows-alt-h';
        $iconmap['core:i/unchecked'] = 'fa fa-square';
        $iconmap['core:i/uncheckedcircle'] = 'fa fa-circle';
        $iconmap['core:i/unflagged'] = 'fa fa-flag';
        $iconmap['core:i/unlock'] = 'fa fa-unlock';
        $iconmap['core:i/up'] = 'fa fa-arrow-up';
        $iconmap['core:i/upload'] = 'fa fa-file-upload';
        $iconmap['core:i/user'] = 'fa fa-user';
        $iconmap['core:i/userevent'] = 'fa fa-user';
        $iconmap['core:i/users'] = 'fa fa-users';
        $iconmap['core:i/valid'] = 'fa fa-check text-success';
        $iconmap['core:i/warning'] = 'fa fa-exclamation-triangle text-danger';
        $iconmap['core:i/withsubcat'] = 'fa fa-plus-square';
        $iconmap['core:m/USD'] = 'fa fa-usd';
        $iconmap['core:movehere'] = 'fa fa-compress-arrows-alt';
        $iconmap['core:req'] = 'fa fa-exclamation-triangle text-danger small-icon mx-2';
        $iconmap['core:t/add'] = 'fa fa-plus-square';
        $iconmap['core:t/addcontact'] = 'fa fa-address-card';
        $iconmap['core:t/approve'] = 'fa fa-thumbs-up';
        $iconmap['core:t/assignroles'] = 'fa fa-user-cog';
        $iconmap['core:t/award'] = 'fa fa-trophy';
        $iconmap['core:t/backpack'] = 'fa fa-shopping-bag';
        $iconmap['core:t/backup'] = 'fa fa-arrow-circle-down';
        $iconmap['core:t/block_to_dock_rtl'] = 'fa fa-chevron-right';
        $iconmap['core:t/block_to_dock'] = 'fa fa-chevron-left';
        $iconmap['core:t/block'] = 'fa fa-ban';
        $iconmap['core:t/calc_off'] = 'fa fa-calculator';
        $iconmap['core:t/calc'] = 'fa fa-calculator';
        $iconmap['core:t/check'] = 'fa fa-check';
        $iconmap['core:t/cohort'] = 'fa fa-users';
        $iconmap['core:t/collapsed_empty_rtl'] = 'fa fa-plus-square';
        $iconmap['core:t/collapsed_empty'] = 'fa fa-plus-square';
        $iconmap['core:t/collapsed_rtl'] = 'fa fa-plus-square';
        $iconmap['core:t/collapsed'] = 'fa fa-plus-square';
        $iconmap['core:t/collapsedcaret'] = 'fa fa-caret-down';
        $iconmap['core:t/contextmenu'] = 'fa fa-cog';
        $iconmap['core:t/copy'] = 'fa fa-copy';
        $iconmap['core:t/delete'] = 'fa fa-trash';
        $iconmap['core:t/dock_to_block_rtl'] = 'fa fa-chevron-right';
        $iconmap['core:t/dock_to_block'] = 'fa fa-chevron-left';
        $iconmap['core:t/dockclose'] = 'fa fa-window-close';
        $iconmap['core:t/down'] = 'fa fa-arrow-down';
        $iconmap['core:t/download'] = 'fa fa-download';
        $iconmap['core:t/downlong'] = 'fa fa-long-arrow-alt-down';
        $iconmap['core:t/dropdown'] = 'fa fa-cog';
        $iconmap['core:t/edit_menu'] = 'fa fa-cog';
        $iconmap['core:t/edit'] = 'fa fa-cog';
        $iconmap['core:t/editinline'] = 'fa fa-edit';
        $iconmap['core:t/editstring'] = 'fa fa-edit';
        $iconmap['core:t/email'] = 'fa fa-envelope-o';
        $iconmap['core:t/email'] = 'fa fa-paper-plane';
        $iconmap['core:t/emailno'] = 'fa fa-ban';
        $iconmap['core:t/emptystar'] = 'fa fa-star';
        $iconmap['core:t/enrolusers'] = 'fa fa-user-plus';
        $iconmap['core:t/expanded'] = 'fa fa-caret-down';
        $iconmap['core:t/export'] = 'fa fa-download';
        $iconmap['core:t/go'] = 'fa fa-play';
        $iconmap['core:t/grades'] = 'fa fa-book-open';
        $iconmap['core:t/groupn'] = 'fa fa-user';
        $iconmap['core:t/groups'] = 'fa fa-user-cog';
        $iconmap['core:t/groupv'] = 'fa fa-user-circle';
        $iconmap['core:t/hide'] = 'fa fa-eye';
        $iconmap['core:t/left'] = 'fa fa-arrow-left';
        $iconmap['core:t/less'] = 'fa fa-caret-up';
        $iconmap['core:t/lock'] = 'fa fa-unlock';
        $iconmap['core:t/locked'] = 'fa fa-lock';
        $iconmap['core:t/locktime'] = 'fa fa-lock';
        $iconmap['core:t/markasread'] = 'fa fa-check';
        $iconmap['core:t/message'] = 'fa fa-comment-dots';
        $iconmap['core:t/messages'] = 'fa fa-comment-dots';
        $iconmap['core:t/more'] = 'fa fa-caret-down';
        $iconmap['core:t/move'] = 'fa fa-arrows-alt-v';
        $iconmap['core:t/online'] = 'fa fa-circle';
        $iconmap['core:t/passwordunmask-edit'] = 'fa fa-edit';
        $iconmap['core:t/passwordunmask-reveal'] = 'fa fa-eye';
        $iconmap['core:t/portfolioadd'] = 'fa fa-plus-square';
        $iconmap['core:t/preferences'] = 'fa fa-cog';
        $iconmap['core:t/preview'] = 'fa fa-search-plus';
        $iconmap['core:t/print'] = 'fa fa-print';
        $iconmap['core:t/removecontact'] = 'fa fa-user-times';
        $iconmap['core:t/reset'] = 'fa fa-redo-alt';
        $iconmap['core:t/restore'] = 'fa fa-arrow-circle-up';
        $iconmap['core:t/right'] = 'fa fa-arrow-right';
        $iconmap['core:t/show'] = 'fa fa-eye-slash text-danger';
        $iconmap['core:t/sort_asc'] = 'fa fa-sort-amount-down';
        $iconmap['core:t/sort_by'] = 'fa fa-sort-amount-up-alt';
        $iconmap['core:t/sort_desc'] = 'fa fa-sort-amount-up';
        $iconmap['core:t/sort'] = 'fa fa-sort';
        $iconmap['core:t/stop'] = 'fa fa-stop';
        $iconmap['core:t/switch_minus'] = 'fa fa-minus-square';
        $iconmap['core:t/switch_plus'] = 'fa fa-plus-square';
        $iconmap['core:t/switch_whole'] = 'fa fa-square';
        $iconmap['core:t/tags'] = 'fa fa-tags';
        $iconmap['core:t/unblock'] = 'fa fa-comment-alt';
        $iconmap['core:t/unlock'] = 'fa fa-lock';
        $iconmap['core:t/unlocked'] = 'fa fa-lock-open';
        $iconmap['core:t/up'] = 'fa fa-arrow-up';
        $iconmap['core:t/uplong'] = 'fa fa-long-arrow-alt-up';
        $iconmap['core:t/user'] = 'fa fa-user';
        $iconmap['core:t/viewdetails'] = 'fa fa-list';
        $iconmap['core:y/loading'] = 'fa fa-circle-notch fa-spin';
        $iconmap['enrol_guest:withoutpassword'] = 'fa fa-unlock-alt';
        $iconmap['enrol_guest:withpassword'] = 'fa fa-key';
        $iconmap['enrol_paypal:icon'] = 'fa fa-cc-paypal';
        $iconmap['enrol_self:withkey'] = 'fa fa-key';
        $iconmap['enrol_self:withoutkey'] = 'fa fa-sign-in-alt';
        $iconmap['gradingform_guide:icon'] = 'fa fa-table';
        $iconmap['gradingform_rubric:icon'] = 'fa fa-table';
        $iconmap['local_boostnavigation:activities'] = 'fa fa-poll-h';
        $iconmap['local_boostnavigation:customnodexs'] = 'fa fa-angle-right';
        $iconmap['local_boostnavigation:customnodexxs'] = 'fa fa-angle-right';
        $iconmap['local_boostnavigation:resources'] = 'fa fa-archive';
        $iconmap['local_downloadcenter:icon'] = 'fa fa-download';
        $iconmap['local_mail:course'] = 'fa fa-graduation-cap';
        $iconmap['local_mail:drafts'] = 'fa fa-copy';
        $iconmap['local_mail:icon'] = 'fa fa-envelope';
        $iconmap['local_mail:inbox'] = 'fa fa-inbox';
        $iconmap['local_mail:sent'] = 'fa fa-paper-plane';
        $iconmap['local_mail:starred'] = 'fa fa-star';
        $iconmap['local_mail:trash'] = 'fa fa-trash-alt';
        $iconmap['local_pages:newspaper'] = 'fa fa-file-alt';
        $iconmap['mod_book:add'] = 'fa fa-plus-square';
        $iconmap['mod_book:chapter'] = 'fa fa-bookmark';
        $iconmap['mod_book:nav_exit'] = 'fa fa-times';
        $iconmap['mod_book:nav_next_dis'] = 'fa fa-arrow-right';
        $iconmap['mod_book:nav_next'] = 'fa fa-arrow-right';
        $iconmap['mod_book:nav_prev_dis'] = 'fa fa-arow-left';
        $iconmap['mod_book:nav_prev'] = 'fa fa-arrow-left';
        $iconmap['mod_book:nav_sep'] = 'fa fa-minus';
        $iconmap['mod_data:field/checkbox'] = 'fa fa-check-square';
        $iconmap['mod_data:field/date'] = 'fa fa-table';
        $iconmap['mod_data:field/file'] = 'fa fa-file';
        $iconmap['mod_data:field/latlong'] = 'fa fa-globe-africa';
        $iconmap['mod_data:field/menu'] = 'fa fa-bars';
        $iconmap['mod_data:field/multimenu'] = 'fa fa-grip-vertical';
        $iconmap['mod_data:field/number'] = 'fa fa-calculator';
        $iconmap['mod_data:field/picture'] = 'fa fa-image';
        $iconmap['mod_data:field/radiobutton'] = 'fa fa-check-circle';
        $iconmap['mod_data:field/text'] = 'fa fa-font';
        $iconmap['mod_data:field/textarea'] = 'fa fa-pen-fancy';
        $iconmap['mod_data:field/url'] = 'fa fa-link';
        $iconmap['mod_feedback:required'] = 'fa fa-exclamation-circle';
        $iconmap['mod_forum:i/pinned'] = 'fa fa-thumbtack';
        $iconmap['mod_forum:t/selected'] = 'fa fa-check';
        $iconmap['mod_forum:t/star'] = 'fa fa-star';
        $iconmap['mod_forum:t/subscribed'] = 'fa fa-envelope-open-text';
        $iconmap['mod_forum:t/unsubscribed'] = 'fa fa-envelope';
        $iconmap['mod_lesson:e/copy'] = 'fa fa-clone';
        $iconmap['mod_scorm:completed'] = 'fa fa-check-circle green';
        $iconmap['mod_scorm:failed'] = 'fa fa-times-circle text-danger';
        $iconmap['mod_scorm:incomplete'] = 'fa fa-spinner text-danger';
        $iconmap['mod_scorm:notattempted'] = 'fa fa-circle';
        $iconmap['mod_scorm:passed'] = 'fa fa-check-circle green';
        $iconmap['mod_scorm:suspend'] = 'fa fa-pause fa-fw ';
        $iconmap['theme:fp/add_file'] = 'fa fa-file';
        $iconmap['theme:fp/alias_sm'] = 'fa fa-share';
        $iconmap['theme:fp/alias'] = 'fa fa-share';
        $iconmap['theme:fp/check'] = 'fa fa-check';
        $iconmap['theme:fp/create_folder'] = 'fa fa-folder-plus';
        $iconmap['theme:fp/cross'] = 'fa fa-remove';
        $iconmap['theme:fp/dnd_arrow'] = 'fa fa-upload';
        $iconmap['theme:fp/download_all'] = 'fa fa-download';
        $iconmap['theme:fp/help'] = 'fa fa-question-circle';
        $iconmap['theme:fp/link_sm'] = 'fa fa-link';
        $iconmap['theme:fp/link'] = 'fa fa-link';
        $iconmap['theme:fp/logout'] = 'fa fa-sign-out-alt';
        $iconmap['theme:fp/path_folder_rtl'] = 'fa fa-folder';
        $iconmap['theme:fp/path_folder'] = 'fa fa-folder';
        $iconmap['theme:fp/refresh'] = 'fa fa-redo-alt';
        $iconmap['theme:fp/search'] = 'fa fa-search';
        $iconmap['theme:fp/setting'] = 'fa fa-cog';
        $iconmap['theme:fp/view_icon_active'] = 'fa fa-th';
        $iconmap['theme:fp/view_list_active'] = 'fa fa-list';
        $iconmap['theme:fp/view_tree_active'] = 'fa fa-folder';
        $iconmap['tool_oauth2:auth'] = 'fa fa-sign-out-alt';
        $iconmap['tool_oauth2:no'] = 'fa fa-times text-danger';
        $iconmap['tool_oauth2:yes'] = 'fa fa-check text-success';
        $iconmap['tool_recyclebin:trash'] = 'fa fa-trash';
        $iconmap['tool_usertours:t/export'] = 'fa fa-download';
        return $iconmap;
    }
}
