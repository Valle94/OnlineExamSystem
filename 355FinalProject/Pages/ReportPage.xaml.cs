using _355FinalProject.Models;

namespace _355FinalProject.Pages;

public partial class ReportPage : ContentPage, IQueryAttributable
{
	string studentID;
	public ReportPage()
	{
		InitializeComponent();
        LoadResults();
	}

	public void ApplyQueryAttributes(IDictionary<string, object> query)
	{
		studentID = query["StudentID"].ToString();
	}

    private async void LoadResults()
    {
        var client = new HttpClient();
#if WINDOWS
        var response = await client.GetAsync("http://localhost/CITA-355-Project-1/Project1/pastExamsNET.php");
#elif ANDROID
        var response = await client.GetAsync("http://10.0.2.2/CITA-355-Project-1/Project1/pastExamsNET.php");
#endif
        var responseString = await response.Content.ReadAsStringAsync();
        var examHistory = System.Text.Json.JsonSerializer.Deserialize<List<ExamHistory>>(responseString);

        for (int i = 0; i < examHistory.Count; i++)
        {
            if (i % 2 == 0) examHistory[i].RowIndex = 0;
            else examHistory[i].RowIndex = 1;
        }

        // Or set specifically to a CollectionView
        ExamHistoryCollection.ItemsSource = examHistory;
    }
}