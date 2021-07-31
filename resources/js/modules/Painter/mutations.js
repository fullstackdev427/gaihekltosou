export const state = {
  painters: {},
};

export const getters = {
  properties: state => state.painters,
  findPainter: state => painter_id => {
    return state.painters.find(painter => painter.id === painter_id);
  },
};

export const mutations = {
  painters(state, value) {
    state.painters = value;
  },
};