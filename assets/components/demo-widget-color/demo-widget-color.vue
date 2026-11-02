<script>
// The colours offered.
const COLORS = ['#e5484d', '#f76b15', '#ffc53d', '#30a46c', '#0090ff', '#8e4ec6'];

// A widget telling the board: the colour pressed goes out as `color`, and is
// kept as the zone's own, so it comes back pressed with the arrangement.
export default {
  template: '#vue-template-wexample-symfony-workspace-demo-bundle-components-demo-widget-color-demo-widget-color',

  props: {
    zoneId: { type: String, required: true },
    config: { type: Object, default: () => ({}) },
    subject: { type: Object, default: null },
    workspace: { type: Object, required: true }
  },

  data() {
    return { colors: COLORS };
  },

  methods: {
    choose(color) {
      this.workspace.updateConfig(this.zoneId, { ...this.config, color });
      this.workspace.emit('color', color);
    }
  }
};
</script>
