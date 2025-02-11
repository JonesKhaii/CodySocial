namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
public function index()
{
// Lấy danh sách bài viết mới nhất, chỉ lấy các cột cần thiết
$posts = Post::select('id', 'title', 'slug', 'summary', 'photo', 'post_cat_id', 'post_tag_id', 'added_by', 'created_at')
->where('status', 'active')
->with([
'category:id,title', // Lấy tiêu đề danh mục bài viết
'tags:id,title', // Lấy tên các tag liên kết với bài viết
'author:id,name', // Lấy thông tin tác giả (name)
])
->latest()
->paginate(6); // Phân trang (6 bài viết mỗi trang)

return view('frontend.index', compact('posts'));
}
}