<script>
// A widget hearing another: the last colour told on the board as `color`,
// kept as its own so the arrangement brings it back.
export default {
  template: '#vue-template-wexample-symfony-workspace-demo-bundle-components-demo-widget-swatch-demo-widget-swatch',

  props: {
    zoneId: { type: String, required: true },
    config: { type: Object, default: () => ({}) },
    subject: { type: Object, default: null },
    workspace: { type: Object, required: true }
  },

  mounted() {
    this.off = this.workspace.on('color', (color) => {
      this.workspace.updateConfig(this.zoneId, { ...this.config, color });
    });
  },

  beforeUnmount() {
    this.off?.();
  }
};
</script>
