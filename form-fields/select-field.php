<?php

/**
 * Shows the `select` form field on job listing forms.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/form-fields/select-field.php.
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
<div class="inline-block relative">
	<select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name=" <?php echo esc_attr(isset($field['name']) ? $field['name'] : $key); ?>" id="<?php echo esc_attr($key); ?>" <?php if (!empty($field['required'])) echo 'required'; ?>>
		<?php foreach ($field['options'] as $key => $value) : ?>
			<option value="<?php echo esc_attr($key); ?>" <?php if (isset($field['value']) || isset($field['default'])) selected(isset($field['value']) ? $field['value'] : $field['default'], $key); ?>><?php echo esc_html($value); ?></option>
		<?php endforeach; ?>
	</select>
	<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
		<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
			<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
	</div>
</div>
<?php if (!empty($field['description'])) : ?><small class="description"><?php echo wp_kses_post($field['description']); ?></small><?php endif; ?>