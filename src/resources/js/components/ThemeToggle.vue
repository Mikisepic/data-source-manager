<template>
	<div class="nav-item theme-toggle clickable">
		<input @change="toggleTheme" id="checkbox" type="checkbox" class="d-none" />
		<label for="checkbox" class="switch">
			<div
				class="slider round clickable"
				:class="{ 'slider-checked': userTheme === 'dark-theme' }"
			>
				<div
					class="mode-icons d-flex align-items-center justify-content-between"
				>
					<span>🌞</span>
					<span>🌚</span>
				</div>
			</div>
		</label>
	</div>
</template>

<script>
	export default {
		mounted() {
			const initUserTheme = this.getTheme() || this.getMediaPreference();
			this.setTheme(initUserTheme);
		},

		data() {
			return {
				userTheme: 'light-theme'
			};
		},

		methods: {
			toggleTheme() {
				const activeTheme = localStorage.getItem('user-theme');
				if (activeTheme === 'light-theme') {
					this.setTheme('dark-theme');
				} else {
					this.setTheme('light-theme');
				}
			},

			getTheme() {
				return localStorage.getItem('user-theme');
			},

			setTheme(theme) {
				localStorage.setItem('user-theme', theme);
				this.userTheme = theme;
				document.documentElement.className = theme;
			},

			getMediaPreference() {
				const hasDarkPreference = window.matchMedia(
					'(prefers-color-scheme: dark)'
				).matches;
				if (hasDarkPreference) {
					return 'dark-theme';
				} else {
					return 'light-theme';
				}
			}
		}
	};
</script>
