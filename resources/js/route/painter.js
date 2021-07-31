const apiPrefix = '/api/' + process.env.MIX_API_VER + '/painter';

export const Web = {
}

export const Api = {
  entry: apiPrefix,
  login: apiPrefix + '/login',
  show: apiPrefix + '/show',
  update: apiPrefix + '/update',
  uploadImage: apiPrefix + '/upload_image',
  deleteImage: apiPrefix + '/delete_image',
  store: apiPrefix + '/store',
  images: apiPrefix + '/images',
  imageurl: apiPrefix + '/imageurl',
  exampleentry: apiPrefix + '/exampleentry',
  inquiry: apiPrefix + '/inquiry',
  updatePassword: apiPrefix + '/update_password',
  withdraw: apiPrefix + '/withdraw',
  columnstore: apiPrefix + '/columnstore',
  getpainterinfo: apiPrefix + '/getpainterinfo',
  getexampleentrylink: apiPrefix + '/getexampleentrylink',
  getevaluation: apiPrefix + '/getevaluation',
  getcolumnlink: apiPrefix + '/getcolumnlink',
  examplelist: apiPrefix + '/examplelist',
  exampleupload: apiPrefix + '/exampleupload',
  deleteexample: apiPrefix + '/deleteexample',
  getcolumn: apiPrefix + '/getcolumn',
  columnupload: apiPrefix + '/columnupload',
  deletecolumn: apiPrefix + '/deletecolumn',
}