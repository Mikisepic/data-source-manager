<template>
  <div class="wrapper">
    <form class="navbar-search">
      <input-base
        placeholder="Insert Reference URL"
        input-classes="form-control"
        addon-right-icon="search"
        v-model="search"
      />
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      search: ''
    };
  }
};
</script>
