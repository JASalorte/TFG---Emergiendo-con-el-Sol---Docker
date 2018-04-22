/* 
 * File:   FileFunctions.h
 * Author: Linkku
 *
 * Created on 21 de abril de 2015, 13:41
 */

#ifndef FILEFUNCTIONS_H
#define	FILEFUNCTIONS_H

#include "UserInfo.h"
#include "LinuxCalls.h"

using namespace std;

string newUser(int number) {
    string user = "user";

    string n = "000";

    string String = static_cast<ostringstream*> (&(ostringstream() << number))->str();

    if (number < 10)
        return user.append("000" + String);
    if (number < 100)
        return user.append("00" + String);
    if (number < 1000)
        return user.append("0" + String);
    if (number >= 1000)
        return user.append("" + String);
}

void modifyUser(const vector<UserInfo>& user, const string& filename) {
    ifstream fs(filename.c_str());
    ofstream fo((filename + ".temp").c_str(), std::ofstream::out);
    char cadena[128];
    UserInfo actual;
    int size;

    for (int i = 0; i < 12; i++) {
        fs.getline(cadena, 128);
        fo << cadena << endl;
    }

    for (int i = 0; i < user.size(); i++) {
        fo << "Usuario:" << user.at(i).GetName() << endl;
        fo << "Central:" << user.at(i).GetCentral() << endl;
    }

    rename((filename + ".temp").c_str(), filename.c_str());

    string command = "sudo chmod 775 " + filename;
    linux_return_function((const char*) command.c_str());
    command = "sudo chown apache:admin " + filename;
    linux_return_function((const char*) command.c_str());
}

string loadHost(const string& filename) {
    ifstream fs(filename.c_str());
    char cadena[128];

    for (int i = 0; i < 7; i++) {
        fs.getline(cadena, 128);
    }

    fs.getline(cadena, 128, ':');
    fs.getline(cadena, 128);
    fs.close();
    return string(cadena);
}

string loadPort(const string& filename) {
    ifstream fs(filename.c_str());
    char cadena[128];

    for (int i = 0; i < 8; i++) {
        fs.getline(cadena, 128);
    }

    fs.getline(cadena, 128, ':');
    fs.getline(cadena, 128);
    fs.close();
    return string(cadena);
}

vector<UserInfo> loadConfig(const string& filename) {
    ifstream fs(filename.c_str());
    char cadena[128];
    int size;
    string raiz;
    vector<UserInfo> user;
    UserInfo actual;

    for (int i = 0; i < 9; i++) {
        fs.getline(cadena, 128);
    }

    fs.getline(cadena, 128, ':');
    fs.getline(cadena, 128);
    raiz = string(cadena);

    fs.getline(cadena, 128, ':');
    fs.getline(cadena, 128);

    size = atoi(cadena);
    user.reserve(size);

    fs.getline(cadena, 128);

    for (int i = 0; i < size; i++) {
        actual.SetNumber(i);
        fs.getline(cadena, 128, ':');
        fs.getline(cadena, 128);
        actual.SetName(cadena);
        fs.getline(cadena, 128, ':');
        fs.getline(cadena, 128);
        actual.SetCentral(cadena);
        user.push_back(actual);
    }

    fs.close();
    return user;
}

void createConfigFile(int tam) {
    ofstream fs("/var/www/html/JSON/Main.conf", std::ofstream::out);
    fs << "#######################################################" << endl;
    fs << "				Creado por" << endl;
    fs << "		Jesús Alberto Salazar Ortega" << endl;
    fs << "			salazarcontactinfo@gmail.com" << endl;
    fs << "		=======================" << endl;
    fs << "##Archivo de configuración para los distintos usuarios" << endl;
    fs << "Nombre del archivo:Main.conf" << endl;
    fs << "Host:150.214.174.39" << endl;
    fs << "Port:10022" << endl;
    fs << "Raiz:user" << endl;
    fs << "Número de usuarios:" << tam << endl;
    fs << "##Listado de los usuarios" << endl;

    for (int i = 0; i < tam; i++) {
        fs << "Usuario" << ":" << newUser(i + 1) << endl;
        fs << "Central:" << endl;
    }

    fs.close();
}

bool OpenCppFileExists(const string& filename) {
    fstream fin;

    //this will fail if more capabilities to read the 
    //contents of the file is required (e.g. \private\...)
    fin.open(filename.c_str(), ios::in);

    if (fin.is_open()) {
        fin.close();
        return true;
    }
    fin.close();

    return false;
}

#endif	/* FILEFUNCTIONS_H */

