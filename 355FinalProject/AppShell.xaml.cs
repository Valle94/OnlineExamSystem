using _355FinalProject.Pages;

namespace _355FinalProject
{
    public partial class AppShell : Shell
    {
        public AppShell()
        {
            InitializeComponent();
            Routing.RegisterRoute("HomePage", typeof(HomePage));
            Routing.RegisterRoute("ExamPage", typeof(ExamPage));
            Routing.RegisterRoute("ResultPage", typeof(ResultPage));
            Routing.RegisterRoute("ReportPage", typeof(ReportPage));
        }
    }
}
