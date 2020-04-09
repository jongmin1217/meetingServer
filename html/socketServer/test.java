import org.json.JSONObject;
import org.json.JSONArray;
import org.json.JSONException;


public class test{
	public static void main(String[] args) {
		try {
			String test = "{\"userInfo\":[{\"num\":\"289\",\"image\":\"http:\\/\\/13.209.4.115\\/profileimage\\/q5.jpg\",\"birth\":\"1995\\/10\\/28\",\"area\":\"서울\",\"nickname\":\"q9shi7r6\"},{\"num\":\"560\",\"image\":\"http:\\/\\/13.209.4.115\\/profileimage\\/4.jpg\",\"birth\":\"1988\\/7\\/16\",\"area\":\"서울\",\"nickname\":\"4fpb12gf\"}]}";
			
			JSONObject userDataObject = new JSONObject(test);
	        JSONArray jsonArray = userDataObject.getJSONArray("userInfo");
	        
	        if (jsonArray.length() != 0) {
	            for (int i = 0; i < jsonArray.length(); i++) {
	                JSONObject postObject = jsonArray.getJSONObject(i);
	              
	                System.out.println(postObject.getString("num"));
	                System.out.println(postObject.getString("image"));
	                
	
	
	            }
	            
	        }
		}catch (JSONException e) {
            e.printStackTrace();
        }
	}
}