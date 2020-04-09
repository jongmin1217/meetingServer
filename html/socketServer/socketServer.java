import org.json.JSONObject;
import org.json.JSONArray;
import org.json.JSONException;
import java.awt.List;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.Serializable;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.net.HttpURLConnection; 
import java.net.URL;
import java.io.BufferedReader;
import java.io.InputStreamReader;



public class socketServer{
	
	private final String USER_AGENT = "Mozilla/5.0";

	
	public static final int serverPort = 5001;
	private DataOutputStream dos_arr;
	HashMap<String, DataOutputStream> map = new HashMap<String, DataOutputStream>();
	
	
	public void go() throws IOException {
        ServerSocket serverSocket = null;
        Socket socket = null; 

        try {
        	serverSocket = new ServerSocket(serverPort);
            System.out.println("S: Server Opend");
            while (true) {
            	socket = serverSocket.accept();
                //System.out.println("hi");
                dos_arr = new DataOutputStream(socket.getOutputStream());
                ServerThread serverThread = new ServerThread(socket, dos_arr);
                serverThread.start();

            }
        } finally {
            if (socket != null)
            	socket.close();
            if (serverSocket != null)
            	serverSocket.close();
            System.out.println("Server Closed");
        }
    }
	
	public class ServerThread extends Thread {
        private Socket socket;
        private DataInputStream dis;
        private DataOutputStream id;
        private ObjectInputStream ois;

        ServerThread(Socket socket, DataOutputStream id) {
            this.socket = socket;
            this.id = id;
        }
        public void run() {
            try {
                service();
            } catch (IOException e) {
            	//map.values().remove(id);
//            	System.out.println(map);
//                System.out.println("exit");
            }
        }

        private void service() throws IOException {
            dis = new DataInputStream(socket.getInputStream());

            String str = null;
            while (true) {
                str = dis.readUTF();
                JSONObject object = new JSONObject(str);
                String type = object.getString("type");
                switch(type) {
                case "start":
                	map.put(object.getString("num"),id);
                	System.out.println(object.getString("num")+"님이 접속하였습니다");
                	break;
                case "end": 
                	map.remove(object.getString("num"));
                	System.out.println(object.getString("num")+"님이 접속을 해제하였습니다");
                	break;
                case "postLike": 
                case "postComent":
                case "userLike":
                case "connect":  
                case "disconnect":
                case "message":
                case "applyFace":
                	send(object);
                	break;
                case "cancelFace":
                case "chatRead":
                case "refuseFace":
                case "facetrans":
                	sendSignal(object);
                	break;
                } 
           }
        }
    }
	
	void sendSignal(JSONObject object) {
		
		try {
			System.out.println("receiveNum : "+object.getString("receiveNum")+"   type : "+object.getString("type"));
			if(map.get(object.getString("receiveNum"))!=null) {
				map.get(object.getString("receiveNum")).writeUTF(object.toString());
			}
			
		}catch(IOException e) {
			e.printStackTrace(); 
		}
			
		
	}
	
	void send(JSONObject object) {
		if(map.get(object.getString("receiveNum"))==null) {
			try {
				sendFCM(object);
			}catch(Exception e) {
				e.printStackTrace();
			}
			
		}else {
			try {
				System.out.println(object.toString());
				map.get(object.getString("receiveNum")).writeUTF(object.toString());
				
			}catch(IOException e) {
				e.printStackTrace(); 
			}
			
		}
	}
	
	private void sendFCM(JSONObject object) throws Exception { 
		URL url = new URL("http://13.209.4.115/fcm.php");
		
		String num = object.getString("num");
    	String sendNum = object.getString("sendNum");
    	String receiveNum = object.getString("receiveNum");
    	String type = object.getString("type");
    	String nickname = object.getString("nickname");
    	String imageUrl = object.getString("imageUrl");
    	String message = object.getString("message");
    	
    	
    	
		String parameters = "num="+num+"&sendNum="+sendNum+"&receiveNum="+receiveNum+
				"&type="+type+"&nickname="+nickname+"&imageUrl="+imageUrl+"&message="+message;
		
		HttpURLConnection con = (HttpURLConnection) url.openConnection(); 
		con.setRequestMethod("POST"); 
		con.setRequestProperty("Content-Type", "application/x-www-form-urlencoded"); 
		con.setDoInput(true);
		con.setDoOutput(true); 
		
		System.out.println(parameters);
		
		DataOutputStream wr = new DataOutputStream(con.getOutputStream()); 
		wr.write(parameters.getBytes("UTF-8"));  
		wr.flush(); 
		wr.close(); 
		int responseCode = con.getResponseCode();
		BufferedReader in = new BufferedReader(new InputStreamReader(con.getInputStream())); 
		String inputLine; 
		StringBuffer response = new StringBuffer(); 
		while ((inputLine = in.readLine()) != null) { 
			response.append(inputLine); 
		} 
		in.close(); 
		// print result 
		System.out.println("FCM 전송 : "+parameters);
//		System.out.println("HTTP 응답 코드 : " + responseCode); 
//		System.out.println("HTTP body : " + response.toString()); 
	}

	
	
	public static void main(String[] args) {
		socketServer server = new socketServer();

        try {
        	server.go();
        } catch (IOException e) {
            e.printStackTrace();
        }
	}
}