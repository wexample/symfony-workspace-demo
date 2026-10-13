<script>
import WorkspaceVueMixin from '@wexample/symfony-workspace/js/Vue/WorkspaceVueMixin';

// The inspector of the slide editor: it reads the channel the rail publishes
// on, and publishes on it too — its previous and next move the rail and the
// centre as a click on a thumbnail would.
export default {
  template: '#vue-template-wexample-symfony-workspace-demo-bundle-components-demo-slide-inspector-demo-slide-inspector',

  mixins: [WorkspaceVueMixin],

  props: {
    channel: {
      type: String,
      required: true
    },
    slides: {
      type: Array,
      default: () => []
    },
    titles: {
      type: Object,
      default: () => ({})
    },
    labels: {
      type: Object,
      default: () => ({})
    }
  },

  computed: {
    current() {
      return this.workspaceSelection(this.channel)[0] ?? null;
    },

    index() {
      return this.slides.indexOf(this.current);
    }
  },

  methods: {
    move(step) {
      const next = this.slides[this.index + step];

      if (next) {
        this.workspaceChannel(this.channel).select(next, 'inspector');
      }
    }
  }
};
</script>
