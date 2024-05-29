import streamlit as st

st.title('Simple Test')
st.write('If you can see this, Streamlit is working correctly.')





import streamlit as st

st.write("秋葉原の平均人口")

import matplotlib.pyplot as plt
from bs4 import BeautifulSoup

# ここから以降は質問者様のコード

def get_population_data(url, district_name):
    response = requests.get(url)
    response.raise_for_status()  # Check if the request was successful

    soup = BeautifulSoup(response.text, 'html.parser')
    tables = soup.find_all('table')
    
    for table in tables:
        headers = table.find_all('th')
        if any(district_name in header.text for header in headers):
            data = []
            rows = table.find_all('tr')
            for row in rows:
                cols = row.find_all(['td', 'th'])
                cols = [ele.text.strip() for ele in cols]
                data.append([ele for ele in cols if ele])
            return data
    return None

def extract_population_for_area(data, area_names):
    population_data = {}
    for row in data:
        for area in area_names:
            if area in row:
                population_data[area] = row
    return population_data

# URL for 千代田区 and 台東区 population data
chiyoda_url = 'https://www.city.chiyoda.lg.jp/koho/kuse/toke/index.html'
taito_url = 'https://www.city.taito.lg.jp/index/research/koseki.html'

# Names of areas in 秋葉原
akihabara_areas_chiyoda = ["外神田", "神田佐久間町", "神田松永町"]
akihabara_areas_taito = ["秋葉原"]

# Get population data for 千代田区 and 台東区
chiyoda_data = get_population_data(chiyoda_url, "千代田区")
taito_data = get_population_data(taito_url, "台東区")

# Extract population for 秋葉原 areas
akihabara_population_chiyoda = extract_population_for_area(chiyoda_data, akihabara_areas_chiyoda)
akihabara_population_taito = extract_population_for_area(taito_data, akihabara_areas_taito)

# Combine and display results
akihabara_population = {**akihabara_population_chiyoda, **akihabara_population_taito}
print("秋葉原の人口データ:")
for area, data in akihabara_population.items():
    print(f"{area}: {data}")

import streamlit as st

