using System.Net.Http.Json;

namespace _355FinalProject.Pages;

public partial class ExamPage : ContentPage, IQueryAttributable
{
    string studentID = "";
    public ExamPage()
    {
        InitializeComponent();
    }
    public void ApplyQueryAttributes(IDictionary<string, object> query)
    {
        studentID = query["StudentID"].ToString();
    }

    private async void SubmitExam_Clicked(object sender, EventArgs e)
    {
        // Question 1
        string q1Ans = "";
        if (q1A.IsChecked) q1Ans = "A";
        else if (q1B.IsChecked) q1Ans = "B";
        else if (q1C.IsChecked) q1Ans = "C";
        else if (q1D.IsChecked) q1Ans = "D";
        else if (q1E.IsChecked) q1Ans = "E";
        else if (q1F.IsChecked) q1Ans = "F";
        else
        {
            await DisplayAlertAsync("Error", "You Did Not Select an Answer for Question 1.", "OK");
            return;
        }

        // Question 2
        string q2Ans = "";
        if (q2A.IsChecked) q2Ans = "A";
        else if (q2B.IsChecked) q2Ans = "B";
        else if (q2C.IsChecked) q2Ans = "C";
        else if (q2D.IsChecked) q2Ans = "D";
        else
        {
            await DisplayAlertAsync("Error", "You Did Not Select an Answer for Question 2.", "OK");
            return;
        }

        // Question 3 (Checkboxes - multiple answers possible)
        List<string> q3Answers = new List<string>();
        if (chk1.IsChecked) q3Answers.Add("A");
        if (chk2.IsChecked) q3Answers.Add("B");
        if (chk3.IsChecked) q3Answers.Add("C");
        if (chk4.IsChecked) q3Answers.Add("D");
        if (chk5.IsChecked) q3Answers.Add("E");
        if (chk6.IsChecked) q3Answers.Add("F");

        // Question 4 (Checkboxes - multiple answers possible)
        List<string> q4Answers = new List<string>();
        if (chk7.IsChecked) q4Answers.Add("A");
        if (chk8.IsChecked) q4Answers.Add("B");
        if (chk9.IsChecked) q4Answers.Add("C");
        if (chk10.IsChecked) q4Answers.Add("D");
        if (chk11.IsChecked) q4Answers.Add("E");

        // Question 5
        string q5Ans = "";
        if (answerPicker.SelectedItem?.ToString() == "4") q5Ans = "4";
        else if (answerPicker.SelectedItem?.ToString() == "5") q5Ans = "5";
        else if (answerPicker.SelectedItem?.ToString() == "6") q5Ans = "6";
        else if (answerPicker.SelectedItem?.ToString() == "7") q5Ans = "7";
        else
        {
            await DisplayAlertAsync("Error", "You Did Not Select an Answer for Question 5.", "OK");
            return;
        }

        var client = new HttpClient();

        var data = new Dictionary<string, string>
    {
        { "q1", q1Ans },
        { "q2", q2Ans },
        { "q3", System.Text.Json.JsonSerializer.Serialize(q3Answers) },
        { "q4", System.Text.Json.JsonSerializer.Serialize(q4Answers) },
        { "q5", q5Ans },
        { "StudentID", studentID }
    };

        var content = new FormUrlEncodedContent(data);

        try
        {
#if WINDOWS
            var response = await client.PostAsync("http://localhost/CITA-355-Project-1/Project1/resultsNet.php", content);
#elif ANDROID
var response = await client.PostAsync("http://10.0.2.2/CITA-355-Project-1/Project1/resultsNet.php", content);
#endif

            var responseString = await response.Content.ReadAsStringAsync();

            // Debug: See what the PHP is returning
            System.Diagnostics.Debug.WriteLine($"PHP Response: {responseString}");

            var result = System.Text.Json.JsonSerializer.Deserialize<Dictionary<string, object>>(responseString);

            if (result != null)
            {
                await Shell.Current.GoToAsync("ResultPage", result);
            }
            else
            {
                string errorMsg = result?.ContainsKey("message") == true ? result["message"].ToString() : "Unknown error";
                await DisplayAlertAsync("Error", $"Failed to submit exam: {errorMsg}", "OK");
            }
        }
        catch (Exception ex)
        {
            await DisplayAlertAsync("Error", $"Network error: {ex.Message}", "OK");
        }
    }
}