<template>
  <div :class="borderColor" class="relative rounded-full ease-linear spinner" style="width: 13px; height: 13px"></div>
</template>
<script>
export default {
    props: {
        borderColor: {
            default: 'before:border-white'
        }
    }
}
</script>
<style>
@keyframes spinner {
  to {
    transform: rotate(360deg);
  }
}

.spinner:before {
  content: "";
  position: absolute;
  top: calc(50% + 4px);
  left: calc(50% + 4px);
  width: 13px;
  height: 13px;
  margin-top: -10px;
  margin-left: -10px;
  border-radius: 50%;
  border-top-width: 2px;
  border-top-style: solid;
  border-right: 2px solid transparent;
  animation: spinner 0.6s linear infinite;
}
</style>
