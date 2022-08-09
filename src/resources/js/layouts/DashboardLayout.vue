<template>
	<div class="wrapper">
		<navbar-wrapper>
			<template v-slot:items>
				<navbar-item
					v-for="(item, index) in items"
					v-bind:key="index"
					:link="item"
				/>
			</template>
		</navbar-wrapper>

		<div class="main-content">
			<div class="container-fluid">
				<router-view />
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				items: [
					{
						name: 'Library',
						icon: 'folder',
						pathName: 'library',
						path: '/library',
						params: {}
					},
					{
						name: 'Collections',
						icon: 'collections_bookmark',
						pathName: 'collections',
						path: '/collections',
						params: {}
					},
					{
						name: 'Groups',
						icon: 'groups',
						pathName: 'groups',
						path: '/groups',
						params: {}
					},
					{
						name: 'Profile',
						icon: 'account_circle',
						pathName: 'profile',
						path: '/profile',
						params: { id: '1' }
					},
					{
						name: 'Settings',
						icon: 'settings',
						pathName: 'settings',
						path: '/settings',
						params: { id: '1' }
					}
				]
			};
		}
	};
</script>
