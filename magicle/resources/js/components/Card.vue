<template>
	<div
		class="card"
		:class="[
			{ shadow: shadow },
			{ [`bg-${type}`]: type },
			{ clickable: clickable }
		]"
	>
		<div
			class="card-header d-flex justify-content-between align-items-center"
			v-if="$slots.header"
		>
			<slot name="header"></slot>
		</div>

		<div class="card-body" :class="bodyClasses" v-if="!noBody">
			<slot></slot>
		</div>

		<div
			class="card-footer d-flex justify-content-between"
			:class="`text-${footerTextPosition}`"
			v-if="$slots.footer"
		>
			<slot name="footer"></slot>
		</div>
	</div>
</template>
<script>
	export default {
		props: {
			type: {
				type: String,
				default: 'default'
			},
			footerTextPosition: {
				type: String,
				default: 'start'
			},
			noBody: {
				type: Boolean,
				default: false
			},
			bodyClasses: {
				type: [String, Object, Array]
			},
			shadow: {
				type: Boolean
			},
			clickable: {
				type: Boolean
			}
		}
	};
</script>