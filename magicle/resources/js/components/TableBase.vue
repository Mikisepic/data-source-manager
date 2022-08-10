<template>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<slot name="columns" :columns="columns">
					<th v-for="column in columns" :key="column">
						{{ column }}
					</th>
				</slot>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(item, index) in data" :key="index">
				<slot :item="item">
					<td v-for="column in columns" :key="column">
						<template v-if="hasValue(item, column)">
							{{ itemValue(item, column) }}
						</template>
					</td>
				</slot>
			</tr>
		</tbody>
	</table>
</template>
<script>
	export default {
		props: {
			columns: {
				type: Array,
				default: () => []
			},
			data: {
				type: Array,
				default: () => []
			}
		},
		methods: {
			hasValue(item, column) {
				return item[column.toLowerCase()] !== 'undefined';
			},
			itemValue(item, column) {
				return item[column.toLowerCase()];
			}
		}
	};
</script>
