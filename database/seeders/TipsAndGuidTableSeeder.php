<?php

namespace Database\Seeders;

use App\Models\TipsAndGuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipsAndGuidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipsAndGuids = [
            [
                'title_en'       => 'How to post your first job',
                'title_ar'       => 'كيفية نشر وظيفتك الأولى',
                'description_en' => 'Posting your first job can feel a little overwhelming, but it’s actually one of the simplest and most exciting steps toward bringing your project to life. The key is to be clear, detailed, and realistic. A well-written job post helps attract the right freelancers and saves you time reviewing irrelevant proposals.
Start by defining exactly what you need. Describe your project’s goals, deliverables, and preferred timeline. The more specific you are, the easier it will be for freelancers to understand your vision and provide accurate proposals. Mention any required skills, experience level, or tools they should be familiar with. If you have examples or references, include them they help freelancers grasp your expectations quickly.
Next, set a fair budget and choose the right payment type. If your project has a defined scope, a fixed price might be best. For ongoing work or flexible tasks, hourly payment gives more freedom. Finally, add a clear and engaging title that reflects what your project is about this is what freelancers see first.
Once your job is live, review proposals carefully. Look beyond just the price check portfolios, reviews, and communication style. Choose the freelancer who best understands your needs, not necessarily the cheapest. Posting your first job is just the beginning with clear communication and trust, you’ll build lasting partnerships that help your business grow.',
                'description_ar' => 'قد يبدو نشر وظيفتك الأولى أمراً مرهقاً قليلاً، لكنه في الواقع أحد أبسط وأكثر الخطوات إثارة نحو إحياء مشروعك. المفتاح هو أن تكون واضحاً ومفصلاً وواقعياً. إعلان الوظيفة المكتوب جيداً يساعد في جذب المستقلين المناسبين ويوفر عليك الوقت في مراجعة المقترحات غير ذات الصلة.
ابدأ بتحديد ما تحتاجه بالضبط. اوصف أهداف مشروعك والمخرجات والجدول الزمني المفضل. كلما كنت أكثر تحديداً، كلما كان من الأسهل على المستقلين فهم رؤيتك وتقديم مقترحات دقيقة. اذكر أي مهارات مطلوبة أو مستوى خبرة أو أدوات يجب أن يكونوا على دراية بها. إذا كان لديك أمثلة أو مراجع، قم بتضمينها فهي تساعد المستقلين على فهم توقعاتك بسرعة.
بعد ذلك، حدد ميزانية عادلة واختر نوع الدفع المناسب. إذا كان مشروعك له نطاق محدد، فقد يكون السعر الثابت هو الأفضل. للعمل المستمر أو المهام المرنة، الدفع بالساعة يعطي حرية أكثر. أخيراً، أضف عنواناً واضحاً وجذاباً يعكس موضوع مشروعك - هذا ما يراه المستقلون أولاً.
بمجرد أن تصبح وظيفتك مباشرة، راجع المقترحات بعناية. انظر إلى ما هو أبعد من السعر فقط - تحقق من المحافظ والمراجعات وأسلوب التواصل. اختر المستقل الذي يفهم احتياجاتك بشكل أفضل، وليس بالضرورة الأرخص. نشر وظيفتك الأولى هو مجرد البداية - مع التواصل الواضح والثقة، ستبني شراكات دائمة تساعد عملك على النمو.',
                'image'          => 'assets/img/tips_and_guids/image1.png',
                'is_popular'     => true,
            ],
            [
                'title_en'       => 'Applying to jobs effectively',
                'title_ar'       => 'التقديم على الوظائف بفعالية',
                'description_en' => 'Landing freelance jobs isn’t just about having the right skills it’s about knowing how to present yourself in a way that captures a client’s attention. Many freelancers send dozens of proposals without success, not because they lack talent, but because their approach doesn’t reflect their value. Applying effectively means being strategic, personal, and professional in every step.
Before applying, take time to read the job post carefully. Understand the client’s goals, tone, and expectations. Use this insight to tailor your proposal so it directly answers what they’re looking for. Instead of writing a generic pitch, make it feel like you wrote it just for them. Show that you understand their challenge and explain how you can solve it this is what makes a proposal stand out.
Your cover letter is your first impression. Start with a friendly introduction, then move into the specific skills or experiences that make you a great fit. Support your claims with short examples or results from past projects numbers and outcomes build credibility. Avoid long paragraphs or unnecessary details; keep it concise, structured, and easy to scan.
Before submitting, review your proposal carefully. Check for spelling mistakes, clarity, and tone. Make sure your proposed rate aligns with your skills and the project’s scope. Finally, be polite and confident clients appreciate professionalism and honesty more than anything.
Applying effectively isn’t about sending the most proposals it’s about sending the right ones. Focus on quality over quantity, build relationships through genuine communication, and you’ll start seeing better results in no time.',
                'description_ar' => 'الحصول على وظائف العمل الحر لا يتعلق فقط بامتلاك المهارات المناسبة - بل يتعلق بمعرفة كيفية تقديم نفسك بطريقة تجذب انتباه العميل. العديد من المستقلين يرسلون عشرات المقترحات دون نجاح، ليس لأنهم يفتقرون إلى الموهبة، ولكن لأن نهجهم لا يعكس قيمتهم. التقديم بفعالية يعني أن تكون استراتيجياً وشخصياً ومهنياً في كل خطوة.
قبل التقديم، خذ وقتاً لقراءة إعلان الوظيفة بعناية. افهم أهداف العميل ونبرته وتوقعاته. استخدم هذه البصيرة لتخصيص مقترحك بحيث يجيب مباشرة على ما يبحث عنه. بدلاً من كتابة عرض عام، اجعله يبدو وكأنك كتبته من أجله فقط. أظهر أنك تفهم تحديه واشرح كيف يمكنك حله - هذا ما يجعل المقترح مميزاً.
رسالة التقديم هي انطباعك الأول. ابدأ بمقدمة ودودة، ثم انتقل إلى المهارات أو الخبرات المحددة التي تجعلك مناسباً بشكل مثالي. ادعم ادعاءاتك بأمثلة قصيرة أو نتائج من مشاريع سابقة - الأرقام والنتائج تبني المصداقية. تجنب الفقرات الطويلة أو التفاصيل غير الضرورية؛ اجعلها مختصرة ومنظمة وسهلة المسح.
قبل الإرسال، راجع مقترحك بعناية. تحقق من الأخطاء الإملائية والوضوح والنبرة. تأكد من أن السعر المقترح يتماشى مع مهاراتك ونطاق المشروع. أخيراً، كن مهذباً وواثقاً - العملاء يقدرون المهنية والصدق أكثر من أي شيء آخر.
التقديم بفعالية لا يتعلق بإرسال أكثر المقترحات - بل بإرسال المقترحات المناسبة. ركز على الجودة أكثر من الكمية، وابنِ العلاقات من خلال التواصل الصادق، وستبدأ في رؤية نتائج أفضل في وقت قصير.',
                'image'          => 'assets/img/tips_and_guids/image2.png',
                'is_popular'     => true,
            ],
            [
                'title_en'       => 'Tips for choosing the right freelancer ',
                'title_ar'       => 'نصائح لاختيار المستقل المناسب',
                'description_en' => 'Choosing the right freelancer can be a defining factor in the success of your project. Before you start browsing profiles, make sure you clearly understand your needs—your project goals, expected deliverables, budget, and timeline. A well-written brief not only helps freelancers understand your requirements but also increases your chances of attracting the right talent.
When reviewing freelancers, focus on their portfolio, experience, and past client reviews. Look for work that aligns with your project type and style, and pay attention to consistent quality and measurable results. Client feedback is equally important as it reflects professionalism, communication skills, and reliability. If you\'re unsure, reach out to the freelancer with a short question and observe their response and clarity — early communication gives you insight into how collaboration may look.
Remember that selecting a freelancer is not just about price. Instead of choosing the lowest offer, focus on value — expertise, proven results, and understanding of your vision. If you\'re uncertain, start with a small task or trial phase before committing to a full contract. With a thoughtful approach, you\'ll find a freelancer who fits your needs and brings your idea to life seamlessly.
Remember that selecting a freelancer is not just about price. Instead of choosing the lowest offer, focus on value — expertise, proven results, and understanding of your vision. If you\'re uncertain, start with a small task or trial phase before committing to a full contract. With a thoughtful approach, you\'ll find a freelancer who fits your needs and brings your idea to life seamlessly.
When reviewing freelancers, focus on their portfolio, experience, and past client reviews. Look for work that aligns with your project type and style, and pay attention to consistent quality and measurable results. Client feedback is equally important as it reflects professionalism, communication skills, and reliability. If you\'re unsure, reach out to the freelancer with a short question and observe their response and clarity — early communication gives you insight into how collaboration may look.',
                'description_ar' => 'اختيار المستقل المناسب يمكن أن يكون عاملاً حاسماً في نجاح مشروعك. قبل أن تبدأ في تصفح الملفات الشخصية، تأكد من أنك تفهم احتياجاتك بوضوح - أهداف مشروعك والمخرجات المتوقعة والميزانية والجدول الزمني. الملخص المكتوب جيداً لا يساعد المستقلين فقط على فهم متطلباتك بل يزيد أيضاً من فرصك في جذب المواهب المناسبة.
                عند مراجعة المستقلين، ركز على محفظة أعمالهم وخبرتهم ومراجعات العملاء السابقين. ابحث عن أعمال تتماشى مع نوع مشروعك وأسلوبه، وانتبه للجودة المتسقة والنتائج القابلة للقياس. تعليقات العملاء مهمة بنفس القدر لأنها تعكس المهنية ومهارات التواصل والموثوقية. إذا كنت غير متأكد، تواصل مع المستقل بسؤال قصير ولاحظ استجابته ووضوحه - التواصل المبكر يمنحك نظرة على كيف قد يبدو التعاون.
                تذكر أن اختيار المستقل لا يتعلق بالسعر فقط. بدلاً من اختيار أقل عرض، ركز على القيمة - الخبرة والنتائج المثبتة وفهم رؤيتك. إذا كنت غير متأكد، ابدأ بمهمة صغيرة أو مرحلة تجريبية قبل الالتزام بعقد كامل. مع النهج المدروس، ستجد مستقلاً يناسب احتياجاتك ويحيي فكرتك بسلاسة.
                تذكر أن اختيار المستقل لا يتعلق بالسعر فقط. بدلاً من اختيار أقل عرض، ركز على القيمة - الخبرة والنتائج المثبتة وفهم رؤيتك. إذا كنت غير متأكد، ابدأ بمهمة صغيرة أو مرحلة تجريبية قبل الالتزام بعقد كامل. مع النهج المدروس، ستجد مستقلاً يناسب احتياجاتك ويحيي فكرتك بسلاسة.
                عند مراجعة المستقلين، ركز على محفظة أعمالهم وخبرتهم ومراجعات العملاء السابقين. ابحث عن أعمال تتماشى مع نوع مشروعك وأسلوبه، وانتبه للجودة المتسقة والنتائج القابلة للقياس. تعليقات العملاء مهمة بنفس القدر لأنها تعكس المهنية ومهارات التواصل والموثوقية. إذا كنت غير متأكد، تواصل مع المستقل بسؤال قصير ولاحظ استجابته ووضوحه - التواصل المبكر يمنحك نظرة على كيف قد يبدو التعاون.',
                'image'          => 'assets/img/tips_and_guids/image3.png',
                'is_popular'     => true,
            ],
        ];

        foreach ($tipsAndGuids as $tipsAndGuid) {
            TipsAndGuid::create($tipsAndGuid);
        }
    }
}
