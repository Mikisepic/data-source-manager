<template>
	<li class="nav-item">
		<router-link
			class="nav-link"
			:to="{ name: link.pathName, params: link.params }"
		>
			<span class="icon d-block d-md-none d-lg-block material-icons-outlined">
				{{ link.icon }}
			</span>
			<span class="item-title">{{ link.name }}</span>
		</router-link>
	</li>
</template>
<script>
	export default {
		props: {
			link: {
				type: Object,
				default: () => {
					return {
						name: '',
						pathName: '',
						path: '',
						icon: '',
						params: {}
					};
				}
			}
		}
	};
</script>
