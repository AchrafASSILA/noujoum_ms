import { createVuetify } from "vuetify";
import { aliases, mdi } from "vuetify/lib/iconsets/mdi-svg";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
// import { VDataTable } from "vuetify/labs/VDataTable";

const vuetify = createVuetify({
    components: {
        ...components,
        // VDataTable,
    },
    directives,
    icons: {
        defaultSet: "mdi",
        aliases,
        sets: {
            mdi,
        },
    },
});

export default vuetify;
