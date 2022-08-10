<template>
	<div
		class="form-group"
		:class="[
			{ 'input-group': hasIcon },
			{ 'has-danger': error },
			{ focused: focused },
			{ 'has-label': label || $slots.label },
			{ 'has-success': valid === true },
			{ 'has-danger': valid === false },
			formClasses
		]"
	>
		<slot name="label">
			<label v-if="label" class="form-control-label" :class="labelClasses">
				{{ label }}
				<span v-if="required">*</span>
			</label>
		</slot>

		<span v-if="addonLeftIcon || $slots.addonLeft" class="input-group-text">
			<slot name="addonLeft">
				<span class="icon material-icons-outlined">{{ addonLeftIcon }}</span>
			</slot>
		</span>

		<slot>
			<input
				:value="modelValue"
				v-bind="$attrs"
				v-on="listeners"
				class="form-control"
				:class="[
					{ 'is-valid': valid === true },
					{ 'is-invalid': valid === false },
					inputClasses
				]"
			/>
		</slot>

		<span
			v-if="addonRightIcon || $slots.addonRight"
			class="input-group-text clickable"
		>
			<slot name="addonRight">
				<span class="icon material-icons-outlined">{{ addonRightIcon }}</span>
			</slot>
		</span>

		<slot name="infoBlock"></slot>
		<slot name="helpBlock">
			<div
				class="text-danger invalid-feedback"
				style="display: block"
				:class="{ 'mt-2': hasIcon }"
				v-if="error"
			>
				{{ error }}
			</div>
		</slot>
	</div>
</template>

<script>
	export default {
		props: {
			required: {
				type: Boolean
			},
			valid: {
				type: Boolean,
				default: undefined
			},
			label: {
				type: String
			},
			error: {
				type: String
			},
			formClasses: {
				type: String
			},
			labelClasses: {
				type: String
			},
			inputClasses: {
				type: String
			},
			modelValue: {
				type: [String, Number]
			},
			addonRightIcon: {
				type: String
			},
			addonLeftIcon: {
				type: String
			}
		},
		data() {
			return {
				focused: false
			};
		},
		computed: {
			listeners() {
				return {
					input: this.updateValue,
					focus: this.onFocus,
					blur: this.onBlur
				};
			},
			hasIcon() {
				const { addonRight, addonLeft } = this.$slots;
				return (
					addonRight !== undefined ||
					addonLeft !== undefined ||
					this.addonRightIcon !== undefined ||
					this.addonLeftIcon !== undefined
				);
			}
		},
		methods: {
			updateValue(evt) {
				let value = evt.target.value;
				this.$emit('update:modelValue', value);
			},
			onFocus(value) {
				this.focused = true;
				this.$emit('focus', value);
			},
			onBlur(value) {
				this.focused = false;
				this.$emit('blur', value);
			}
		}
	};
</script>
