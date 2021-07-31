import Slider from 'js/components/Slider.vue';

import ColumnCreateForm from 'js/components/column/CreateForm.vue';
import BusinessDiscussion from 'js/components/form/BusinessDiscussion.vue';
import ChatForm from 'js/components/form/ChatForm.vue';

import CommonInquiryForm from 'js/components/common/Inquiryform.vue';

import UserEntryForm from 'js/components/user/EntryForm.vue';
import UserLoginForm from 'js/components/user/LoginForm.vue';
import UserUpdateForm from 'js/components/user/UpdateForm.vue';
import UserProfileForm from 'js/components/user/ProfileImageForm.vue';
import UserPropertyList from 'js/components/user/PropertyList.vue';
import UserPainterList from 'js/components/user/PainterList.vue';
import PainterSearchBar from 'js/components/user/PainterSearchBar.vue';
import UserFavoriteList from 'js/components/user/FavoriteList.vue';
import UserEvaluation from 'js/components/user/Evaluation.vue';
import UserInquiryForm from 'js/components/user/Inquiryform.vue';
import UserUpdatePasswordForm from 'js/components/user/UpdatePasswordForm.vue';
import UserWithdrawForm from 'js/components/user/WithdrawForm.vue';
import StarRatingEvaluate from 'js/components/user/StarRatingEvaluate.vue';
import BulkQuatationForm from 'js/components/user/BulkQuatationForm.vue';
import ColumnList from 'js/components/user/ColumnList.vue';
import ConstructionCaseList from 'js/components/user/ConstructionCaseList.vue';
import ColumnDetail from 'js/components/user/ColumnDetail.vue';
import StarRatingTotal from 'js/components/user/StarRatingTotal.vue';
import StarRating from 'js/components/user/StarRating.vue';
import PainterSearchForm from 'js/components/form/PainterSearchForm.vue';

import PainterEntryForm from 'js/components/painter/EntryForm.vue';
import PainterLoginForm from 'js/components/painter/LoginForm.vue';
import PainterUpdateForm from 'js/components/painter/UpdateForm.vue';
import PainterProfileForm from 'js/components/painter/ProfileImageForm.vue';
import PainterPropertyList from 'js/components/painter/PropertyList.vue';
import PainterInquiryForm from 'js/components/painter/Inquiryform.vue';
import PainterUpdatePasswordForm from 'js/components/painter/UpdatePasswordForm.vue';
import PainterWithdrawForm from 'js/components/painter/WithdrawForm.vue';
import PainterExampleEntryForm from 'js/components/painter/ExampleEntryForm.vue';
import Progress from 'js/components/painter/ProfileProgress.vue';
import PainterImages from 'js/components/painter/Images.vue';
import PainterConstructionCaseList from 'js/components/painter/ConstructionCaseList.vue';
import PainterColumnList from 'js/components/painter/ColumnList.vue';
import PainterDetail from 'js/components/painter/Detail.vue';
import PainterPreview from 'js/components/painter/Preview.vue';

import SideBar from 'js/components/admin/SideBar.vue';
import Pagination from 'js/components/admin/Pagination.vue';
import AdminList from 'js/components/admin/AdminList.vue';
import WorkerList from 'js/components/admin/WorkerList.vue';
import WorkerDetail from 'js/components/admin/WorkerDetail.vue';
import ClientList from 'js/components/admin/ClientList.vue';
import ClientDetail from 'js/components/admin/ClientDetail.vue';
import RequestItemDetail from 'js/components/admin/RequestItemDetail.vue';
import Columns from 'js/components/admin/ColumnList.vue';
import ColumnDetailAdmin from 'js/components/admin/ColumnDetailAdmin.vue';
import Examples from 'js/components/admin/ExampleList.vue';
import ConstructionCaseDetail from 'js/components/admin/ConstructionCaseDetail.vue';
import RankDetail from 'js/components/admin/RankDetail.vue';
import Evaluations from 'js/components/admin/EvaluationList.vue';
import NoticeList from 'js/components/admin/NoticeList.vue';
import NoticeCreate from 'js/components/admin/NoticeCreate.vue';
import NoticeEdit from 'js/components/admin/NoticeEdit.vue';
import NoticeShow from 'js/components/admin/NoticeShow.vue';
//import AlertModal from 'js/components/AlertModal.vue';

export const AppComponents = {
    'slider': Slider,
    'column-create-form': ColumnCreateForm,
    'chat-form': ChatForm,
    'business-discussion': BusinessDiscussion,

    'common-inquiry-form': CommonInquiryForm,

    'user-entry-form': UserEntryForm,
    'user-login-form': UserLoginForm,
    'user-update-form': UserUpdateForm,
    'user-profile-form': UserProfileForm,
    'user-property-list': UserPropertyList,
    'user-painter-list': UserPainterList,
    'user-favorite-list': UserFavoriteList,
    'starratingevaluate': StarRatingEvaluate,
    'bulk-quatation': BulkQuatationForm,
    'column-list': ColumnList,
    'construction-case-list':ConstructionCaseList,
    'column-detail': ColumnDetail,
    'overall-rating': StarRatingTotal,
    'starrating': StarRating,
    'user-evaluation': UserEvaluation,
    'user-inquiry-form': UserInquiryForm,
    'user-update-password-form': UserUpdatePasswordForm,
    'user-withdraw-form': UserWithdrawForm,
    'painter-search-form': PainterSearchForm,

    'painter-entry-form': PainterEntryForm,
    'painter-login-form': PainterLoginForm,
    'painter-update-form': PainterUpdateForm,
    'painter-profile-form': PainterProfileForm,
    'painter-property-list': PainterPropertyList,
    'painter-exampleentry-form': PainterExampleEntryForm,
    'painter-profile-progress': Progress,
    'painter-search-bar' : PainterSearchBar,
    'painter-images': PainterImages,
    'painter-inquiry-form': PainterInquiryForm,
    'painter-update-password-form': PainterUpdatePasswordForm,
    'painter-withdraw-form': PainterWithdrawForm,
    'painter-construction-case-list':PainterConstructionCaseList,
    'painter-column-list':PainterColumnList,
    'painter-detail': PainterDetail,
    'painter-preview': PainterPreview,

    'adminsidebar': SideBar,
    'adminpagination': Pagination,
    'adminlist': AdminList,
    'workerlist': WorkerList,
    'workerdetail': WorkerDetail,
    'clientlist': ClientList,
    'clientdetail': ClientDetail,
    'requestitemdetail': RequestItemDetail,
    'columnlist': Columns,
    'columndetailadmin': ColumnDetailAdmin,
    'examplelist': Examples,
    'constructioncasedetail': ConstructionCaseDetail,
    'evaluationlist': Evaluations,
    'noticelist': NoticeList,
    'notice-create': NoticeCreate,
    'notice-edit': NoticeEdit,
    'notice-show': NoticeShow,
    'rankdetail': RankDetail,

    //'alert-modal':AlertModal,
}