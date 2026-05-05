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
        string q1Ans = "";
        string q2Ans = "";
        string[] q3Ans = [];
        string[] q4Ans = [];
        string q5Ans = "";

        await DisplayAlertAsync("Submitted", "Your exam has been submitted.", "OK");

        if (q1A.IsChecked) q1Ans = "A";
        else if (q1B.IsChecked) q1Ans = "B";
        else if (q1C.IsChecked) q1Ans = "C";
        else if (q1D.IsChecked) q1Ans = "D";
        else if (q1E.IsChecked) q1Ans = "E";
        else if (q1F.IsChecked) q1Ans = "F";
        else 
        {
            await DisplayAlertAsync("Error", "You Did Not Select an Answer.", "OK");
            return; 
        } ;



        if (q2A.IsChecked) q2Ans = "A";
        else if (q2B.IsChecked) q2Ans = "B";
        else if (q2C.IsChecked) q2Ans = "C";
        else if (q2D.IsChecked) q2Ans = "D";
        else
        {
            await DisplayAlertAsync("Error", "You Did Not Select an Answer.", "OK");
            return;
        }


        if (chk1.IsChecked) q3Ans.Append("A");
        else if(chk2.IsChecked) q3Ans.Append("B");
        else if(chk3.IsChecked) q3Ans.Append("C");
        else if(chk4.IsChecked) q3Ans.Append("D");
        else if(chk5.IsChecked) q3Ans.Append("E");
        else if(chk6.IsChecked) q3Ans.Append("F");
        // ["B","C"]

        if (chk7.IsChecked) q4Ans.Append("A");
        else if (chk8.IsChecked) q4Ans.Append("B");
        else if (chk9.IsChecked) q4Ans.Append("C");
        else if (chk10.IsChecked) q4Ans.Append("D");
        else if (chk11.IsChecked) q4Ans.Append("E");


        if (answerPicker.SelectedItem?.ToString() == "4") q5Ans = "4";
        else if (answerPicker.SelectedItem?.ToString() == "5") q5Ans = "5";
        else if (answerPicker.SelectedItem?.ToString() == "6") q5Ans = "6";
        else if (answerPicker.SelectedItem?.ToString() == "7") q5Ans = "7";
        else
        {
            await DisplayAlertAsync("Error", "You Did Not Select an Answer.", "OK");
            return;
        }

        var client = new HttpClient();

        var data = new Dictionary<string, string>
        {
            { "q1", q1Ans},
            { "q2", q2Ans },
            { "q3", q3Ans.ToString() },
            { "q4", q4Ans.ToString()},
            { "q5", q5Ans },
            { "StudentID", "1"}
        };


        var content = new FormUrlEncodedContent(data);

        var response = await client.PostAsync(
            "http://localhost/CITA355/CITA-355-Project-1/Project1/resultsNet.php",
            content);

        string result = await response.Content.ReadAsStringAsync();

        await DisplayAlertAsync("Success", result, "OK");

    }



}