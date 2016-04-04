
#include <SPI.h>
#include <Ethernet.h>
#include <MFRC522.h>
#include <aJSON.h>
#include <LiquidCrystal.h>

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFF, 0xED };

char server[] = "192.168.1.8";    

IPAddress ip(192, 168, 1, 101);

EthernetClient client;

#define SS_PIN 53
#define RST_PIN 40

MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.
LiquidCrystal lcd(8, 9, 4, 5, 6,7);

//#define SS_PIN 10
//#define RST_PIN 9
//MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance.



//Variaveis para a comunicação
String resposta ="";
String codigo = "10";
String laboratorio = "2";
String tagAnterior = "";

#define BIP 21

void msgDisplay(String msg){
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print(msg);
    Serial.println(msg);
}

void autenticar(String identificador) {
    
    String dados = "{\"laboratorio\":\""+laboratorio+"\",\"identificador\":\""+identificador+"\"}";
    
    if (client.connect(server, 80)) {
      msgDisplay("Autenticando...");
      client.println("POST /SistemaAcesso/AbrirPorta/autenticar/ HTTP/1.1");
      client.println("Host: 192.168.1.8");
      client.println("Content-Type:application/json");
      client.print("Content-Length: ");
      client.println(dados.length());
      client.println();
      client.println(dados);    
    }
    do{
      if (client.available()) {
        char c = client.read();       
        String auxiliar (c);
        resposta = resposta + auxiliar;
      }
    }while(client.connected());
    // if the server's disconnected, stop the client:
  
    if (!client.connected()) {
      
      client.stop();
      resposta.remove(0,495);
      //resposta.remove(resposta.length()-1);

      char buf[resposta.length()+10];
      resposta.toCharArray(buf, sizeof(buf));
      aJsonObject* jsonObject = aJson.parse(buf);
      
      String c = aJson.getObjectItem(jsonObject,"c")->valuestring;
      
      if(c.equals("a5e2y6")){
        msgDisplay(aJson.getObjectItem(jsonObject,"p")->valuestring);


        
      }else{
        msgDisplay(aJson.getObjectItem(jsonObject,"p")->valuestring);
      }
    
    }else{
      msgDisplay("Falha geral!");
    }
    resposta = "";
  }

void setup() {
  Serial.begin(9600);
  while (!Serial) {
  }

  // start the Ethernet connection:
  if (Ethernet.begin(mac) == 0) {
     Ethernet.begin(mac, ip);
  }
  lcd.begin(16, 2);
  SPI.begin();      // Inicia  SPI bus
  mfrc522.PCD_Init();   // Inicia MFRC522
  msgDisplay("Aproxime o seu cartao do leitor...");
  pinMode(BIP, OUTPUT);
} 
void loop() {
     // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()){
    return;
  }
  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  String conteudo= "";
  byte letra;
  
  for (byte i = 0; i < mfrc522.uid.size; i++) {
     conteudo.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     conteudo.concat(String(mfrc522.uid.uidByte[i], HEX));
  }
  
  conteudo.toUpperCase();

  if(tagAnterior != conteudo){
    digitalWrite(BIP, HIGH);
    delay(500);
    digitalWrite(BIP, LOW);
    tagAnterior = conteudo;
    autenticar(conteudo.substring(1));
  }
  else{
    digitalWrite(BIP, HIGH);
    delay(100);
    digitalWrite(BIP, LOW);
    delay(50);
    digitalWrite(BIP, HIGH);
    delay(100);
    digitalWrite(BIP, LOW);
  }
}

