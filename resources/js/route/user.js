const apiPrefix = '/api/' + process.env.MIX_API_VER + '/user';

export const Web = {
}

export const Api = {
  entry: apiPrefix,
  login: apiPrefix + '/login',
  show: apiPrefix + '/show',
  update: apiPrefix + '/update',
  uploadImage: apiPrefix + '/upload_image',
  deleteImage: apiPrefix + '/delete_image',
  properties: apiPrefix + '/properties',
  search: apiPrefix + '/search',
  examplelist: apiPrefix + '/examplelist',
  evaluationupdate: apiPrefix + '/evaluationupdate',
  painterprofileimage: apiPrefix + '/painterprofileimage',
  painterimages: apiPrefix + '/painterimages',
  painterimageurl: apiPrefix + '/painterimageurl',
  exampleimageurl: apiPrefix + '/exampleimageurl',
  getevaluation: apiPrefix + '/getevaluation',
  getevaluationcount: apiPrefix + '/getevaluationcount',
  favorite: apiPrefix + '/favorite',
  addfavorite: apiPrefix + '/addfavorite',
  deletefavorite: apiPrefix + '/deletefavorite',
  inquiry: apiPrefix + '/inquiry',
  updatePassword: apiPrefix + '/update_password',
  withdraw: apiPrefix + '/withdraw',
  getcolumn: apiPrefix + '/getcolumn',
}