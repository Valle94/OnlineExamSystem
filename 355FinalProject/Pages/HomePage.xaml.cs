namespace _355FinalProject.Pages;

public partial class HomePage : ContentPage, IQueryAttributable
{
	string studentID;
	public HomePage()
	{
		InitializeComponent();
	}

	public void ApplyQueryAttributes(IDictionary<string, object> query)
	{
		studentID = query["StudentID"].ToString() ?? "";
	}

    private async void StartExamClicked(object sender, EventArgs e)
    {
		var idDictionary = new Dictionary<string, object>
		{
			{ "StudentID", studentID }
		};

		await Shell.Current.GoToAsync("ExamPage", idDictionary);
    }

    private async void ViewPastExamsClicked(object sender, EventArgs e)
    {
		var parameters = new Dictionary<string, object>
		{
			{ "StudentID", studentID }
		};

		await Shell.Current.GoToAsync("ReportPage", parameters);
    }
}