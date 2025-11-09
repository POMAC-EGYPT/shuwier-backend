<?php

namespace Database\Seeders;

use App\Models\HowItWork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HowItWorkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $howItWorksClient = [
            [
                'title_en'       => 'Post your project or search',
                'title_ar'       => 'انشر مشروعك أو ابحث',
                'description_en' => 'Create a job post with your requirements or browse freelancers directly.',
                'description_ar' => 'قم بإنشاء منشور وظيفة مع متطلباتك أو تصفح المستقلين مباشرةً.',
                'type'           => 'client',
                'image'          => 'assets/img/how_it_works/image1.png',
            ],
            [
                'title_en'       => 'Choose the right freelancer',
                'title_ar'       => 'اختر المستقل المناسب',
                'description_en' => 'Review proposals, check profiles, compare skills, and explore portfolios',
                'description_ar' => 'راجع المقترحات، تحقق من الملفات الشخصية، قارن المهارات، واستعرض المحافظ.',
                'type'           => 'client',
                'image'          => 'assets/img/how_it_works/image2.png',
            ],
            [
                'title_en'       => 'Get it done',
                'title_ar'       => 'أنجز المهمة',
                'description_en' => 'Collaborate, track progress, and release payment securely.',
                'description_ar' => 'تعاون، تتبع التقدم، وأصدر الدفعات بأمان.',
                'type'           => 'client',
                'image'          => 'assets/img/how_it_works/image3.png',
            ],
        ];

        $howItWorksFreelancer = [
            [
                'title_en'       => 'Browse Projects',
                'title_ar'       => 'تصفح المشاريع',
                'description_en' => 'Discover new opportunities that match your skills.',
                'description_ar' => 'اكتشف فرصًا جديدة تتناسب مع مهاراتك.',
                'type'           => 'freelancer',
                'image'          => 'assets/img/how_it_works/image4.png',
            ],
            [
                'title_en'       => 'Submit a Proposal',
                'title_ar'       => 'قدم عرضًا',
                'description_en' => 'Craft a convincing offer and showcase your expertise.',
                'description_ar' => 'قم بصياغة عرض مقنع وعرض خبراتك.',
                'type'           => 'freelancer',
                'image'          => 'assets/img/how_it_works/image5.png',
            ],
            [
                'title_en'       => 'Work & Get Paid',
                'title_ar'       => 'اعمل واحصل على أجر',
                'description_en' => 'Complete the job, deliver high-quality work, and receive secure payments.',
                'description_ar' => 'أكمل المهمة، قدم عملًا عالي الجودة، وتلقى المدفوعات بأمان.',
                'type'           => 'freelancer',
                'image'          => 'assets/img/how_it_works/image6.png',
            ],
        ];

        for ($i = 0; $i < 3; $i++) {
            HowItWork::create($howItWorksClient[$i]);
            HowItWork::create($howItWorksFreelancer[$i]);
        }
    }
}
