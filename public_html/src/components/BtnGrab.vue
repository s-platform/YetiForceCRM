<!--
/**
 * Button grab component
 *
 * @description Global component
 * @license YetiForce Public License 3.0
 * @author Tomasz Poradzewski <t.poradzewski@yetiforce.com>
 */
-->
<template>
	<a class="grabbable text-decoration-none q-px-xs" href="#">
		<q-icon :class="[grabClass]" name="mdi-drag" :size="size" />
	</a>
</template>

<script>
export default {
  name: 'BtnGrab',
  props: {
    grabClass: {
      type: String,
    },
    size: {
      type: String,
      required: false
    }
  }
}
</script>

<style scoped>
.grabbable:hover {
  cursor: move;
  cursor: grab;
  cursor: -moz-grab;
  cursor: -webkit-grab;
}
.grabbable:active {
  cursor: grabbing;
  cursor: -moz-grabbing;
  cursor: -webkit-grabbing;
}
</style>
