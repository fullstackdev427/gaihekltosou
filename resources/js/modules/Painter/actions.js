import axios from 'axios';
import { Api } from "js/route/painter.js";

export default {
  async loadPreview({ commit }) {
    await axios.get(Api.show).then(response => {
      commit('painters', [response.data]);
    }).catch(e => {
      throw e;
    });
  },
};