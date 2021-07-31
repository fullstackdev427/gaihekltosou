const apiPrefix = '/api/' + process.env.MIX_API_VER + '/column';

export const Web = {
}

export const Api = {
  index: apiPrefix,
  create: apiPrefix + '/create',
  store: apiPrefix + '/store',
  show: apiPrefix + '/show',
  edit: apiPrefix + '/edit',
  update: apiPrefix + '/update',
  destroy: apiPrefix + '/destroy',
  list: apiPrefix + '/list',
}