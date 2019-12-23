<?php

/**
 * Shows the `text` form field on job listing forms.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/form-fields/text-field.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.31.1
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="<?php echo esc_attr(isset($field['name']) ? $field['name'] : $key); ?>" <?php if (isset($field['autocomplete']) && false === $field['autocomplete']) {
																																																																																																																																									echo ' autocomplete="off"';
																																																																																																																																								} ?> id="<?php echo esc_attr($key); ?>" placeholder="<?php echo empty($field['placeholder']) ? '' : esc_attr($field['placeholder']); ?>" value="<?php echo isset($field['value']) ? esc_attr($field['value']) : ''; ?>" maxlength="<?php echo esc_attr(!empty($field['maxlength']) ? $field['maxlength'] : ''); ?>" <?php if (!empty($field['required'])) echo 'required'; ?> />
<?php if (!empty($field['description'])) : ?><small class="description"><?php echo wp_kses_post($field['description']); ?></small><?php endif; ?>