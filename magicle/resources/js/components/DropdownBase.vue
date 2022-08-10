<template>
	<div
		class="dropdown"
		:class="[{ show: isOpen }, { [`drop${direction}`]: direction }]"
	>
		<a
			class="btn btn-sm btn-icon-only"
			id="dropdownMenu"
			data-bs-toggle="dropdown"
			aria-expanded="false"
		>
			<span class="icon material-icons-outlined">{{ icon }}</span>
			<span class="no-icon">{{ title }}</span>
		</a>

		<ul
			class="dropdown-menu"
			:class="[{ show: isOpen }, menuClasses]"
			aria-labelledby="dropdownMenu"
		>
			<slot></slot>
		</ul>
	</div>
</template>
<script>
	export default {
		props: {
			direction: {
				type: String,
				default: 'down'
			},
			title: {
				type: String
			},
			icon: {
				type: String
			},
			position: {
				type: String
			},
			menuClasses: {
				type: [String, Object]
			}
		},
		data() {
			return {
				isOpen: false
			};
		},
		methods: {
			toggleDropDown() {
				this.isOpen = !this.isOpen;
				this.$emit('change', this.isOpen);
			},
			closeDropDown() {
				this.isOpen = false;
				this.$emit('change', this.isOpen);
			}
		}
	};
</script>
