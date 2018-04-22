/* 
 * File:   main.cpp
 * Author: Linkku
 *
 * Created on 30 de enero de 2015, 11:49
 */

#define BOOST_FILESYSTEM_NO_DEPRECATED

#include <mysql.h>

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <vector>
#include <iostream>
#include <fstream>
#include <limits>
#include <sstream>
#include <unistd.h>
#include <map>
#include <iterator>

#include "FileFunctions.h"
#include "LinuxCalls.h"
#include "UserInfo.h"
#include "Interface.h"

#include <sys/types.h>
#include <sys/inotify.h>
#include <sys/time.h>
#include <ctime>



#define EVENT_SIZE  ( sizeof (struct inotify_event) )
#define BUF_LEN     ( 1024 * ( EVENT_SIZE + 16 ) )

using namespace std;


int main(int argc, char **argv) {
	

	

    vector<UserInfo> user;

    cout << "#################### Iniciando el servidor V0.1 ####################" << endl << endl;

    string initial_dir = "/var/www/html/JSON/Main.conf";


    if (!OpenCppFileExists(initial_dir)) {
        cout << "El archivo Main.conf no existe\n" <<
                "Se está iniciando el servidor por primera vez\n" <<
                "¿Desea crearlo?\n1.- Si\n2.- No" << endl;
        if (getchar() == '1') {
            int var = 0;
            while (var <= 0) {
                cout << "¿Cuantos usuarios desea crear inicialmente?" << endl;
                cin >> var;
                std::cin.clear();
                std::cin.ignore(numeric_limits<std::streamsize>::max(), '\n');

                if (var <= 0)
                    cout << "Tiene que introducir un número mayor que 0" << endl;

                cout << endl << endl;
            }
            createConfigFile(var);
        } else {
            cout << "No se puede continuar sin una configuración.\nSaliendo..." << endl;
            return 0;
        }
    }

    string host = loadHost(initial_dir);
    string port = loadPort(initial_dir);

    cout << "#############Cargando archivo de configuración Main.conf.##################" << endl << endl;
    user = loadConfig(initial_dir);
    loadedUsersUI(user);
    user = centralComprobationUI(user);
    modifyUser(user, initial_dir);
    userFirstComprobationUI(user, host, port);

    /*for (int i = 0; i < user.size(); i++) {
	linux_return_function(string("sudo chmod g-w /home/" + user.at(i).GetName()).c_str());
	linux_return_function(string("sudo chmod 700 /home/" + user.at(i).GetName() + "/.ssh").c_str());
	linux_return_function(string("sudo chmod 600 /home/" + user.at(i).GetName() + "/.ssh/authorized_keys").c_str());
    }*/

    cout << "###############Archivo de configuracion cargado##############" << endl << endl;

    cout << "Iniciando polling de archivos" << endl;

    int i = 0;
    std::map<std::string, std::string> mapfile;
    std::map<std::string, std::string> maplocal;
    string line;
    char buffer[BUF_LEN];

    /*wd.push_back(inotify_add_watch(fd, "/var/www/html/JSON", IN_CLOSE_WRITE));

    for (int x = 0; x < user.size(); x++)
        wd.push_back(inotify_add_watch(fd, string("/home/" + user.at(x).GetName() + "/workdir").c_str(), IN_CLOSE_WRITE));*/

	
    while (1) {
        

        MYSQL *conn;
        MYSQL_RES *res;
        MYSQL_ROW row;
        char *server = "localhost";
        char *userlogin = "gestor";
        char *password = ""; 
        char *database = "EmergiendoConElSol";
        conn = mysql_init(NULL);
        /* Connect to database */
        if (!mysql_real_connect(conn, server, userlogin, password, database, 0, NULL, 0)) {
            fprintf(stderr, "%s\n", mysql_error(conn));
            exit(1);
        }

	cout << "#############Recargando archivo de configuración Main.conf.##################" << endl << endl;
	user = loadConfig(initial_dir);
	loadedUsersUI(user);
	user = centralComprobationUI(user);
	modifyUser(user, initial_dir);
	userFirstComprobationUI(user, host, port);

	cout << "###############Archivo de configuracion cargado##############" << endl << endl;

	/*wd.clear();

	for (int x = 0; x < user.size(); x++)
		wd.push_back(string("/home/" + user.at(x).GetName() + "/workdir").c_str());*/

            


	for (int x = 0; x < user.size(); x++) {
		//cout << "Ha cambiado el archivo " + string(event->name) + " del user: " + user.at(pos - 1).GetName() << endl;
		//linux_return_function(string("sudo chmod 755 /home/" + user.at(pos - 1).GetName() + "/workdir/" + event->name).c_str());

		/*linux_return_function(string("sudo chmod g-w /home/" + user.at(i).GetName()).c_str());
		linux_return_function(string("sudo chmod 700 /home/" + user.at(i).GetName() + "/.ssh").c_str());
		linux_return_function(string("sudo chmod 600 /home/" + user.at(i).GetName() + "/.ssh/authorized_keys").c_str());*/
			
		
		string savedir = "/home/" + user.at(x).GetName() + "/filecheck";
		cout << "Vamos a procesar la central: " << user.at(x).GetName() << endl;
		
		/*Load file here*/
		mapfile.clear();

		std::ifstream savefile;
		savefile.open(savedir.c_str());
		while(!savefile.eof()){
			std::getline (savefile,line);
			//cout << line.substr(0, 11) << "-" << line.substr(12, line.size()-1) << endl;
			if(line.size() == 0)
				break;
			mapfile[line.substr(0, 11)] = line.substr(12, line.size()-1);
			
			//cout << line.substr(0, 11) << "-" << line.substr(12, line.size()-1) << endl;
			//sleep (2); 
		}
		savefile.close();

		cout << "Hemos cargado en el mapa " << mapfile.size() << " entradas del archivo de guardado." << endl;

		/*Check status for this iteration*/
		maplocal.clear();
		vector<string> result = linux_return_function(string("stat /home/" + user.at(x).GetName() + "/workdir/*").c_str());
		if(result.size() != 1)
			for(int y=0; y < result.size()/8; y++){
				maplocal[result[y*8].substr(32, 11)] = result[y*8 + 5].substr(8, 19);
			}
		
		cout << "Hemos cargado en el mapa " << maplocal.size() << " entradas a partir del estado actual." << endl;

		std::ofstream savelocal;
		savelocal.open(savedir.c_str(), std::ifstream::trunc);
		std::map<std::string, std::string>::iterator it = maplocal.begin();
    		while(it != maplocal.end()){
			if(maplocal[it->first] != mapfile[it->first]){	
				string query = "LOAD DATA LOCAL INFILE '/home/" + user.at(x).GetName() + "/workdir/" + it->first + ".csv' "
					"REPLACE "
					"INTO TABLE data "
					"FIELDS TERMINATED BY ';' ENCLOSED BY '' "
					"LINES TERMINATED BY '\n' STARTING BY '' "
					"IGNORE 1 LINES"
					"(@d,@var1, @var2, @var3,@var4,@var5,@var6,@var7,@var8,@var9,@var10,@var11,@var12,@var13,@var14,@var15)"
					"SET central = '" + user.at(x).GetCentral() + "', "
					"date = UNIX_TIMESTAMP(CONVERT_TZ(STR_TO_DATE(@d, '%d/%m/%Y %H:%i:%s'), '+00:00', @@global.time_zone)),"
					"var1 = REPLACE(@var1, ',', '.'),"
					"var2 = REPLACE(@var2, ',', '.'),"
					"var3 = REPLACE(@var3, ',', '.'),"
					"var4 = REPLACE(@var4, ',', '.'),"
					"var5 = REPLACE(@var5, ',', '.'),"
					"var6 = REPLACE(@var6, ',', '.'),"
					"var10 = REPLACE(@var10, ',', '.'),"
					"var11 = REPLACE(@var11, ',', '.'),"
					"var12 = REPLACE(@var12, ',', '.'),"
					"var13 = REPLACE(@var13, ',', '.'),"
					"var14 = REPLACE(@var14, ',', '.'),"
					"var15 = REPLACE(@var15, ',', '.');";
				//send SQL query
				if (mysql_query(conn, query.c_str())) {
					fprintf(stderr, "%s\n", mysql_error(conn));
				}else{
					cout << "Procesado " << it->first << endl;
				}
			}
			savelocal << it->first << ' ' << it->second << '\n';
			it++;
		}

		savelocal.close();
	}
	cout << "Esperando 60 segundos" << endl;
        mysql_close(conn);
	sleep(60);
    }


    return 0;

}

