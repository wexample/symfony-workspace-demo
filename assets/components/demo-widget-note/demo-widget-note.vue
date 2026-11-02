<script>
// A note kept with its zone: what is written is the zone's config, saved with
// the arrangement when it settles.
export default {
  template: '#vue-template-wexample-symfony-workspace-demo-bundle-components-demo-widget-note-demo-widget-note',

  props: {
    zoneId: { type: String, required: true },
    config: { type: Object, default: () => ({}) },
    subject: { type: Object, default: null },
    workspace: { type: Object, required: true }
  },

  methods: {
    onInput(event) {
      this.workspace.updateConfig(this.zoneId, { ...this.config, text: event.target.value });
    }
  }
};
</script>
